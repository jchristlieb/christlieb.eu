<template>
    <div>
        <button type="button" class="btn btn-primary" @click="toggleModal">Add Image</button>
        <!-- Modal -->
     <modal v-if="showModal" @close="showModal = false">
         <div class="flex flex-wrap">
             <div v-if="loading" class="text-center">
                 <i class="fal fa-spinner fa-pulse fa-5x"></i>
             </div>
                 <div class="w-1/4" v-for="image in images" >
                     <img :class="{selected: image.id == selected.id}" :src="'/storage/' + image.path" @click="selectImage(image)"/>
                 </div>
         </div>
         <div class="modal-footer">
             <button type="button" class="text-white bg-blue-light rounded py-2 px-4" @click="save">Save</button>
             <button type="button" class="text-black py-2 px-4" @click="toggleModal">Cancel</button>
         </div>
     </modal>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showModal: false,
                loading: false,
                images: [],
                selected: false
            }
        },
        methods: {
            toggleModal(){
              if(this.images.length <= 0){
                  this.loadImages()
              }
              this.showModal = !this.showModal
            },
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
                this.$emit('selected', this.selected);
                this.toggleModal();
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
