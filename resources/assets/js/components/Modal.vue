<template>
        <div @click.self="dismissModal" class="pin absolute flex items-center justify-center bg-transparent-black z-10 p-8">
            <div class="bg-white rounded shadow p-4 max-w-lg max-h-full overflow-y-scroll">
                <slot></slot>
            </div>
        </div>
</template>

<script>
    export default {
        props: ['type'],
        data() {
            return {
                show: false
            }
        },
        computed: {
            typeColor() {
                let color;
                switch (this.type) {
                    case 'success':
                        color = 'bg-green hover:bg-green-dark'
                        break;
                    case 'error':
                        color = 'bg-red hover:bg-red-dark'
                        break;
                    case 'warning':
                        color = 'bg-yellow hover:bg-yellow-dark'
                        break;
                    default:
                        color = 'bg-blue hover:bg-blue-dark'
                }

                return color;
            }
        },
        methods: {
            dismissModal() {
                this.$emit('close')
            }
        }
    }
</script>
