<template>
    <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <div class="mb-4">
            <label for="name">Name:</label>

            <input type="text" id="name" name="name" class="field" v-model="form.name">

            <span class="text-red" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
        </div>

        <div class="mb-4">
            <label for="email">Email:</label>

            <input type="text" id="email" name="email" class="field" v-model="form.email">

            <span class="text-red" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
        </div>

        <div class="mb-4">
            <label for="message">Message:</label>

            <textarea id="message" name="message" class="field" v-model="form.message"></textarea>

            <span class="text-red" v-if="form.errors.has('message')" v-text="form.errors.get('message')"></span>
        </div>

        <div class="mb-4">
            <button class="btn" :disabled="form.isDisabled()">Submit</button>
        </div>
    </form>
</template>

<script>
    const Form = require('../services/form');
    export default {
        props: ['url'],
        data() {
            return {
                form: new Form({
                    name: '',
                    email: '',
                    message: '',
                })
            }
        },
        methods: {
            onSubmit() {
                this.form.submit(this.url);
            }
        }
    }
</script>
