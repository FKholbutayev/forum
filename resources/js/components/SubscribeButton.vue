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
            return ['btn', this.activeStatus ? 'btn-primary' : 'btn-secondary']
        },
    },

    data() {
        return {
            activeStatus: this.active
        }
    },

    methods: {
        subscribe() {
            let requestType = !this.activeStatus ? 'post' : 'delete'

            axios[requestType](location.pathname + '/subscriptions')
            this.activeStatus = !this.activeStatus

            flash('Subscribed to thread')
        }
    }
}
</script>

<style scoped>

</style>
