<template>
    <div>
        <h1 class="font-condensed font-bold text-grey-dark text-5xl mb-4">Profile</h1>
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
    </div>
</template>

<script>
    export default {
        props: ['userData'],
        data() {
            return {
                edit: false,
                user: JSON.parse(this.userData)
            }
        },
        methods: {
            toggleEdit(){
                this.edit = !this.edit;
            }
        }
    }
</script>
