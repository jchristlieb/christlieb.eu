<template>
    <form @submit.prevent="submit">
        <div class="mb-4">
            <button type="button" class="btn" @click="imageModal = true">Add Image</button>
            <!-- Modal -->
            <modal v-if="imageModal" @close="imageModal = false">
                <images-component :with-save="true" @save="fillImage"/>
            </modal>
        </div>
        <img v-if="article.image_id" :src="'/storage/' + image.path"/>
        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" type="text"
                   class="field"
                   :class="{'is-invalid': errors.title}"
                   placeholder="New thread"
                   v-model="article.title">
            <span class="invalid-feedback" v-if="errors.title">
                <strong>{{ errors.title[0] }}</strong>
            </span>
        </div>

        <div class="form-group">
            <label class="hidden" for="content">Content</label>

            <wysiwyg
                    :class="{'is-invalid': errors.content}"
                    placeholder="Write your article..."
                    id="content"
                    v-model="article.content">
            </wysiwyg>
            <span class="invalid-feedback" v-if="errors.content">
                <strong>{{ errors.content[0] }}</strong>
            </span>
        </div>
        <div class="form-group pt-4">
            <div class="mb-4">
                <label>Tags</label>
            </div>
            <tags-input id="tags" v-model="article.tags"></tags-input>
        </div>
        <div class="">
            <datepicker v-model="article.date"></datepicker>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">save</button>
        </div>
    </form>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import Wysiwyg from "./Wysiwyg";

    export default {
        components: {
            Wysiwyg,
            Datepicker
        },
        props: ['url', 'dataArticle'],
        data() {
            return {
                method: 'post',
                article: {
                    title: '',
                    content: '',
                    tags: [],
                    image_id: false,
                    published_at: false
                },
                imageModal: false,
                image: {},
                errors: {}
            }
        },
        created() {
            if (this.dataArticle) {
                this.article = JSON.parse(this.dataArticle);
                this.image = this.article.image;
                this.method = 'patch'
            }
        },
        methods: {
            submit() {
                axios({
                    method: this.method,
                    url: this.url,
                    data: this.article
                }).then(response => {
                    if(this.method === 'post'){
                    }else{
                    flash('Article updated', 'success');
                    }
                    this.clear();
                })
                    .catch(error => {
                        console.log(error.response.data.errors);
                        this.errors = error.response.data.errors;
                    });
            },
            clear() {
                this.article = {
                    title: '',
                    content: '',
                    tags: [],
                };
            },
            fillImage(image) {
                this.imageModal = false;
                this.image = image;
                this.article.image_id = image.id;
            }
        }
    }
</script>


