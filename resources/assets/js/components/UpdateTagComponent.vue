<template>
    <div class="mb-5">
        <div v-if="edit" class="mb-4">
            <button type="button" class="btn" @click="imageModal = true">Add Image</button>
            <!-- Modal -->
            <modal v-if="imageModal" @close="imageModal = false">
                <images-component :with-save="true" @save="fillImage"/>
            </modal>
        </div>
        <img v-if="tag.image_id" :src="imagePath"/>
        <p v-if="!edit">{{tag.name}}</p>
        <div class="form-group" v-else="">
            <input id="tag-input" class="field" :class="{'border-red': errors.name}" v-model="tag.name"/>
            <div v-if="errors.name" class="text-red">
                {{errors.name[0]}}
            </div>
        </div>

        <button class="btn" @click="toggleEdit">
            <span v-if="!edit">Edit</span>
            <span v-else>Cancel</span>
        </button>
        <button v-if="edit" class="btn" @click="update">
            <span>Save</span>
        </button>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['dataTag', 'url'],
        data() {
            return {
                tag: JSON.parse(this.dataTag),
                edit: false,
                errors: false,
                imageModal: false,
                image: {}
            }
        },
        computed: {
          imagePath(){
              if(this.image.path){
                  return '/storage/' + this.image.path;
              }
              return '/storage/' + this.tag.image.path;
          }
        },
        methods: {
            update() {
                const response = this.patch(this.url, this.tag);

                response.then(response => {
                    this.tag = response.data;
                    this.errors = false;
                    this.edit = false;
                    flash('Tag updated', 'success');
                });

                response.catch(error => {
                    this.errors = error.response.data.errors;
                    flash('Error while updating Tag', 'warning');
                })
            },
            fillImage(image) {
                this.imageModal = false;
                this.image = image;
                this.tag.image_id = image.id;
            },
            patch(url, tag) {
                return axios.patch(url, tag)
            },
            toggleEdit() {
                this.edit = !this.edit;
            }
        }
    }
</script>
