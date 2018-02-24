<template>
    <div>
        <input id="trix" type="hidden" :name="name" :value="value">

        <trix-editor
                ref="trix"
                input="trix"
                @trix-change="change"
                @trix-attachment-add="upload"
                :placeholder="placeholder">
        </trix-editor>
    </div>
</template>

<style lang="scss">
    @import '~trix/dist/trix.css';
</style>

<script>
    import Trix from 'trix';

    export default {
        props: ['name', 'value', 'placeholder'],

        methods: {
            change({target}) {
                this.$emit('input', target.value)
            },
            upload({attachment}) {
                console.log(attachment);
                const formData = new FormData();
                formData.append('image', attachment.file);
                axios.post('/admin/images', formData,
                    {
                        headers: { 'content-type': 'multipart/form-data' },
                        onUploadProgress: progressEvent => {
                            let percentCompleted = Math.floor((progressEvent.loaded * 100) / progressEvent.total);
                            attachment.setUploadProgress(percentCompleted);
                        }
                    })
                    .then(response => {
                        console.log(response);
                        return attachment.setAttributes({
                            url: response.data.image_url,
                        })
                    })
                    .catch(error => { console.log(error.response)})
            }
        },

        watch: {
            value(val) {
                if (val === '') {
                    this.$refs.trix.value = '';
                }
            }
        }
    }
</script>

<style scoped>
trix-editor {
    min-height: 300px;
}
</style>

