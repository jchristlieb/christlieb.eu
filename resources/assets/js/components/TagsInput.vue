<template>
    <div class="tags-input">
    <span v-for="tag in tags" class="badge badge-primary">
      <span>{{ tag }}</span>
      <a href="#" @click.prevent="removeTag(tag)"><i class="fal fa-times"></i></a>
    </span>
        <input placeholder="Add tag..."
               @keydown.backspace="handleTagBackspace"
               @keydown.enter.prevent="addTag"
               v-model="newTag"
        >
    </div>
</template>

<script>
    export default {
        model: {
            prop: 'tags',
            event: 'update'
        },
        props: ['tags'],
        data() {
            return {
                newTag: '',
            }
        },
        methods: {
            handleTagBackspace(e) {
                if (this.newTag.length === 0) {
                    this.$emit('update', this.tags.slice(0, -1))
                }
            },
            addTag() {
                if (this.newTag.length === 0 || this.tags.includes(this.newTag)) {
                    return
                }
                this.$emit('update', [...this.tags, this.newTag]);
                this.newTag = ''
            },
            removeTag(tag) {
                this.$emit('update', this.tags.filter(t => t !== tag))
            },
        },
    }
</script>
