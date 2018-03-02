<template>
    <form @submit.prevent="submit">
        <div class="mb-4">
            <button type="button" class="btn" @click="imageModal = true">Add Image</button>
            <!-- Modal -->
            <modal v-if="imageModal" @close="imageModal = false">
                <images-component with-save="true" @save="fillImage"/>
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

<style scoped>
    /* http://prismjs.com/download.html?themes=prism&languages=markup+css+clike+javascript */
    /**
     * prism.js default theme for JavaScript, CSS and HTML
     * Based on dabblet (http://dabblet.com)
     * @author Lea Verou
     */

    code[class*="language-"],
    pre[class*="language-"] {
        color: black;
        text-shadow: 0 1px white;
        font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
        direction: ltr;
        text-align: left;
        white-space: pre;
        word-spacing: normal;
        word-break: normal;
        word-wrap: normal;
        line-height: 1.5;

        -moz-tab-size: 4;
        -o-tab-size: 4;
        tab-size: 4;

        -webkit-hyphens: none;
        -moz-hyphens: none;
        -ms-hyphens: none;
        hyphens: none;
    }

    pre[class*="language-"]::-moz-selection, pre[class*="language-"] ::-moz-selection,
    code[class*="language-"]::-moz-selection, code[class*="language-"] ::-moz-selection {
        text-shadow: none;
        background: #b3d4fc;
    }

    pre[class*="language-"]::selection, pre[class*="language-"] ::selection,
    code[class*="language-"]::selection, code[class*="language-"] ::selection {
        text-shadow: none;
        background: #b3d4fc;
    }

    @media print {
        code[class*="language-"],
        pre[class*="language-"] {
            text-shadow: none;
        }
    }

    /* Code blocks */
    pre[class*="language-"] {
        padding: 1em;
        margin: .5em 0;
        overflow: auto;
    }

    :not(pre) > code[class*="language-"],
    pre[class*="language-"] {
        background: #f5f2f0;
    }

    /* Inline code */
    :not(pre) > code[class*="language-"] {
        padding: .1em;
        border-radius: .3em;
    }

    .token.comment,
    .token.prolog,
    .token.doctype,
    .token.cdata {
        color: slategray;
    }

    .token.punctuation {
        color: #999;
    }

    .namespace {
        opacity: .7;
    }

    .token.property,
    .token.tag,
    .token.boolean,
    .token.number,
    .token.constant,
    .token.symbol,
    .token.deleted {
        color: #905;
    }

    .token.selector,
    .token.attr-name,
    .token.string,
    .token.char,
    .token.builtin,
    .token.inserted {
        color: #690;
    }

    .token.operator,
    .token.entity,
    .token.url,
    .language-css .token.string,
    .style .token.string {
        color: #a67f59;
        background: hsla(0, 0%, 100%, .5);
    }

    .token.atrule,
    .token.attr-value,
    .token.keyword {
        color: #07a;
    }

    .token.function {
        color: #DD4A68;
    }

    .token.regex,
    .token.important,
    .token.variable {
        color: #e90;
    }

    .token.important,
    .token.bold {
        font-weight: bold;
    }

    .token.italic {
        font-style: italic;
    }

    .token.entity {
        cursor: help;
    }

</style>
