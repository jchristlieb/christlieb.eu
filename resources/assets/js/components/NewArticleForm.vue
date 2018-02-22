<template>
    <form @submit.prevent="submit">
        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" type="text"
                   class="form-control"
                   :class="{'is-invalid': errors.title}"
                   placeholder="New thread"
                   v-model="article.title">
            <span class="invalid-feedback" v-if="errors.title">
                <strong>{{ errors.title[0] }}</strong>
            </span>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control"
                      :class="{'is-invalid': errors.content}"
                      name="content"
                      id="content"
                      rows="7"
                      placeholder="Write your article..."
                      v-model="article.content">
            </textarea>
            <span class="invalid-feedback" v-if="errors.content">
                <strong>{{ errors.content[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <tags-input id="tags" v-model="article.tags"></tags-input>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">save</button>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['url'],
        data() {
            return {
                article: {
                    title: '',
                    content: '',
                    tags: [],
                },
                errors: {}
            }
        },
        methods: {
            submit() {
               axios.post(this.url, this.article)
                   .then(response => {
                       flash('New Article created', 'success');
                   })
                   .catch(error => {
                       console.log(error.response.data.errors);
                       this.errors = error.response.data.errors;
                   });
            }
        }
    }
</script>
