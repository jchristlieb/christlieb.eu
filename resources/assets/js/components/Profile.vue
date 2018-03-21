<template>
    <div>
        <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">Profile</h1>
        <img v-if="user.image_id" :src="imagePath"/>
        <div class="flex justify-between">
            <div v-if="!edit">
                <p class="mb-2 text-grey-dark">Name: {{user.name}}</p>
                <p class="mb-2 text-grey-dark">Email: {{user.email}}</p>
                <p class="mb-2 text-grey-dark">{{user.description}}</p>
            </div>
            <div v-else class="flex-1">
                <button type="button" class="btn" @click="imageModal = true">Add Image</button>
                <!-- Modal -->
                <modal v-if="imageModal" @close="imageModal = false">
                    <images-component :with-save="true" @save="fillImage"/>
                </modal>
                <div class="mb-2 flex">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="field" v-model="user.name"/>
                </div>
                <div class="mb-2 flex">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="field" v-model="user.email"/>
                </div>
                <div class="mb-2 flex">
                    <label for="description">Description</label>
                    <textarea rows="7" id="description" class="field" v-model="user.description"></textarea>
                </div>
            </div>
            <div>
                <button class="btn" @click="toggleEdit">
                    <span v-if="!edit">Edit</span>
                    <span v-if="edit">Exit</span>
                </button>
                <button class="ml-2 btn" v-if="edit" @click="save">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    import http from './../services/http';
    import flash from '../services/flash';
    export default {
        props: ['userData'],
        data() {
            return {
                edit: false,
                user: JSON.parse(this.userData),
                imageModal: false,
                image: {}
            }
        },
        computed: {
            imagePath() {
                if (this.image.path) {
                    return '/storage/' + this.image.path;
                }
                return '/storage/' + this.user.image.path;
            }
        },
        methods: {
            toggleEdit() {
                this.edit = !this.edit;
            },
            save(){
                http.patch('/admin/profile', this.user,(status, data) => {
                    this.toggleEdit();
                    flash.success('Profile updated');
                })
            },
            fillImage(image) {
                this.imageModal = false;
                this.image = image;
                this.user.image_id = image.id;
            },
        }
    }
</script>
