<template>
    <div>
        <a v-for="tag in tags" :href="'/tags/' + tag.slug">
            <span :style="{fontSize:getFontSize(tag)}">{{tag.name}}</span>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['dataTags'],
        data() {
            return {
                tags: JSON.parse(this.dataTags),
                fontMin: 10,
                fontMax: 25,
            }
        },
        computed: {
            maxCount() {
                return Math.max.apply(Math, this.tags.map(tag => tag.articles_count));

            },
            minCount() {
                return Math.min.apply(Math, this.tags.map(tag => tag.articles_count));
            }
        },
        methods: {
            getFontSize(tag) {
                let size = tag.articles_count === this.minCount ? this.fontMin
                    : (tag.articles_count / this.maxCount) * (this.fontMax - this.fontMin) + this.fontMin;
                return size + 'px';
            }
        }
    }
</script>
