<template>
    <div>
        <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">Profile</h1>
        <div class="flex justify-between">
            <div v-if="!edit">
                <p class="mb-2 text-grey-dark">Name: {{user.name}}</p>
                <p class="mb-2 text-grey-dark">Email: {{user.email}}</p>
            </div>
            <div v-else>
                <div class="mb-2 flex">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="field" v-model="user.name"/>
                </div>
                <div class="mb-2 flex">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="field" v-model="user.email"/>
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
                user: JSON.parse(this.userData)
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
            }
        }
    }
</script>
