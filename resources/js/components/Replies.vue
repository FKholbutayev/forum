<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id" class="mt-4">
            <reply @deleted="remove(index)" :data="reply"></reply>
        </div>
        <paginator @updated="fetch" :dataSet="dataSet"></paginator>

        <new-reply :endpoint="endpoint" @created="add"></new-reply>

    </div>
</template>


<script>
import Reply from "./Reply";
import NewReply from "./NewReply";
import collection from "./mixins/collection";
export  default {
    components: {
        NewReply,
        Reply
    },
    mixins: [collection],

    data() {
        return {
            dataSet: {},
            endpoint: location.pathname +'/replies'
        }
    },

    created() {
        this.fetch()
    },

    methods: {
        url(page = 1) {
            return location.pathname +'/replies?page=' + page
        },

        fetch(page) {
            axios.get(this.url(page))
                 .then(this.refresh)
        },

        refresh({ data }) {
            this.dataSet = data
            this.items = data.data
            window.scrollTo(0,0)
        },



    }
}
</script>
