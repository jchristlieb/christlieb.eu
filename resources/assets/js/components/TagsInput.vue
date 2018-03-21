<template>
    <div class="tags-input">

        <span v-for="tag in tags" class="tags-input-tag">
      <span>{{ tag.name }}</span>
      <button type="button" class="tags-input-remove" @click="removeTag(tag)">&times;</button>
    </span>
        <input class="tags-input-text" placeholder="Add tag..."
               @keydown.backspace="handleTagBackspace"
               @keydown.enter.prevent="addTag"
               v-model="newTag.name">
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
                newTag: {name: ''},
            }
        },
        methods: {
            handleTagBackspace(e) {
                if (this.newTag.name.length === 0) {
                    this.$emit('update', this.tags.slice(0, -1))
                }
            },
            addTag() {
                if (this.newTag.name.length === 0 || this.tags.find((tag) => {
                        return tag.name === this.newTag
                    })) {
                    return
                }
                this.$emit('update', [...this.tags, this.newTag]);
                this.newTag = {name: ''}
            },
            removeTag(tag) {
                this.$emit('update', this.tags.filter(t => t.name !== tag.name))
            },
        },
    }
</script>
