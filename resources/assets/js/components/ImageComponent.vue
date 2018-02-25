<template>
    <div>
        <button type="button" class="btn btn-primary" @click="loadImages" data-toggle="modal"
                data-target="#exampleModalLong">Add Image
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="loading" class="text-center">
                            <i class="fal fa-spinner fa-pulse fa-5x"></i>
                        </div>
                        <div v-else class="row">
                            <div class="col-sm-3 mb-3" v-for="image in images" >
                                <img :class="{selected: image.id == selected.id}" :src="'/storage/' + image.path" @click="selectImage(image)"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                images: [],
                selected: false
            }
        },
        methods: {
            loadImages() {
                this.loading = true;
                axios.get('/admin/images').then(response => {
                    this.images = response.data;
                    this.loading = false;
                })
            },
            selectImage(image){
                this.selected = image;
            },
            save(){
                this.$emit('selected', this.selected)
            }
        }
    }
</script>

<style scoped="">
    .selected{
        border:1px solid red;
        box-shadow: 0 2px 2px 2px #eee;
    }
</style>
