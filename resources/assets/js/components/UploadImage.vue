<template>
    <div class="profile-image">
        <form @submit.prevent="uploadImage" enctype="multipart/form-data">
            <img class="img-circle" :src="image">
            <label for="inputImage" v-if="!image">
                <span class="btn">Choose Image</span>
            </label>
            <input class="hidden" id="inputImage" type="file" @change="onFileChange">
            <div class="form-group">
                <button type="submit" class="btn" v-if="isChanged">Upload</button>
            </div>
        </form>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                image: '',
                isChanged: false,
                file: ''
            }
        },

        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.file = files[0];
                console.log(this.file);
                this.createImage(files[0]);
                this.isChanged = true;
            },
            createImage(file) {
                let image = new Image();
                let reader = new FileReader();

                reader.onload = (e) => {
                    this.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.image = '';
            },
            uploadImage() {
                const data = new FormData();
                data.append('image', this.file);
                axios.post('/admin/images', data)
                    .then(response => {
                        this.image = false;
                        this.$emit('upload', response.data);
                        this.isChanged = false;
                    })
                    .catch(error => {
                        console.log('catch');
                        console.log(error);
                    })
            }
        }
    }
</script>
