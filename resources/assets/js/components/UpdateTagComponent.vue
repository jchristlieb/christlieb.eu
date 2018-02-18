<template>
    <div class="mb-5">
        <p v-if="!edit">{{tag.name}}</p>
        <div class="form-group" v-else="">
            <input id="tag-input" class="form-control" :class="{'is-invalid': errors.name}" v-model="tag.name"/>
            <div v-if="errors.name" class="invalid-feedback">
                {{errors.name[0]}}
            </div>
        </div>

        <button class="btn btn-primary" @click="toggleEdit">
            <i :class="{fal:true,'fa-edit': !this.edit, 'fa-times': this.edit}"></i>
        </button>
        <button v-if="edit" class="btn btn-primary" @click="update">
            <i class="fal fa-save"></i>
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
                errors: false
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
            patch(url, tag) {
                return axios.patch(url, tag)
            },
            toggleEdit() {
                this.edit = !this.edit;
            }
        }
    }
</script>
