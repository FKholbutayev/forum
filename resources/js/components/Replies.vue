<template>
    <div>
        <div v-for="(reply, index) in items" class="mt-4">
            <reply @deleted="remove(index)" :data="reply"></reply>
        </div>
        <new-reply :endpoint="endpoint" @created="add"></new-reply>

    </div>
</template>


<script>
import Reply from "./Reply";
import NewReply from "./NewReply";
export  default {
    props: {
        data: {
            type: Array
        }
    },

    components: {
        NewReply,
        Reply
    },

    data() {
        return {
            items: this.data,
            endpoint: location.pathname +'/replies'
        }
    },
    methods: {
        remove(index) {
            this.items.splice(index, 1);
            this.$emit('remove')
            flash("Reply has been deleted")

        },
        add(reply) {
            this.items.push(reply)
            this.$emit('added')
        }

    }
}
</script>
