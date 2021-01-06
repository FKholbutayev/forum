<template>
    <div>
        <div v-for="(reply, index) in items" class="mt-4">
            <reply @deleted="remove(index)" :data="reply"></reply>
        </div>
    </div>
</template>


<script>
import Reply from "./Reply";
export  default {
    props: {
        data: {
            type: Array
        }
    },

    components: {
        Reply
    },

    data() {
        return {
            items: this.data
        }
    },
    methods: {
        remove(index) {
            this.items.splice(index, 1);
            this.$emit('remove')
            flash("Reply has been deleted")

        }

    }
}
</script>
