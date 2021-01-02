<template>
    <button type="submit" :class="classes" @click="toggle">
        <i class="fa fa-heart"></i>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
    export default {
        props: {
            reply: {
                type: Object
            }
        },

        data() {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited
            }
        },

        methods: {
            create() {
                axios.post(`/replies/${this.reply.id}/favorites`)

                this.isFavorited = true
                this.favoritesCount++
            },
            destroy() {
                axios.delete(`/replies/${this.reply.id}/favorites`)

                this.isFavorited = false
                this.favoritesCount--
            },

            toggle() {
               this.isFavorited ? this.destroy() : this.create()
            }
        },

        computed: {
            classes() {
                return ['btn ', this.isFavorited ? 'btn-outline-primary' : 'btn-outline-secondary']
            }
        },
    }
</script>

<style>

</style>
