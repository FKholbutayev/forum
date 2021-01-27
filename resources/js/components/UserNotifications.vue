<template>
    <li class="nav-item dropdown" v-if="notifications.length>0">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false" v-pre>
            Notifications
            <i class="bi bi-bell"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right"
             aria-labelledby="navbarDropdown"
             v-for="notification in notifications">

            <a class="dropdown-item"
               :href="notification.data.link"
               @click="markAsRead(notification)"
               v-text="notification.data.message">
            </a>

        </div>
    </li>
</template>

<script>

export default {

    created() {
        this.fetch()
    },

    data() {
        return {
            notifications: []
        }
    },

    methods: {
        fetch() {
            axios.get("/profiles/" + window.App.user.name + "/notifications")
                 .then(response => this.notifications = response.data)
        },

        markAsRead(notification) {
            axios.delete("/profiles/" +window.App.user.name + "/notifications/" + notification.id)

        }
    }
}

</script>

<style scoped>

</style>
