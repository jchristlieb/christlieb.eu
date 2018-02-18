<template>
    <div>
        <p v-if="!edit">{{tag.name}}</p>
        <input id="tag-input" v-else="" class="form-control" v-model="tag.name"/>
        <button class="btn btn-primary" @click="toggleEdit">
            <i :class="{fal:true,'fa-edit': !this.edit, 'fa-save': this.edit}"></i>
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
                edit: false
            }
        },
        methods: {
            update() {
                axios.patch(this.url, this.tag)
                    .then(response => {
                        this.tag = response.data;
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            },
            toggleEdit(){
                if(this.edit){
                    this.update();
                }
                this.edit = !this.edit;

            }
        }
    }
</script>
