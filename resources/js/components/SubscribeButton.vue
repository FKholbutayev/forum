<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
export default {
    props: {
        active: {
            type: Boolean
        }
    },
    computed: {
        classes() {
            return ['btn', this.active ? 'btn-primary' : 'btn-default']
        }
    },

    methods: {
        subscribe() {
            let requestType = !this.active ? 'post' : 'delete'

            axios[requestType](location.pathname + '/subscriptions')
            this.active = !this.active

            flash('Subscribed to thread')
        }
    }
}
</script>

<style scoped>

</style>
