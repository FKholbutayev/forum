<template>
    <div>
        <slot :repliesCount="repliesCount"
              :decreaseCount="decreaseCount"></slot>
    </div>
</template>

<script>
import Replies from "../components/Replies";
export default {
    components: {
        Replies
    },

    props: {
        initialRepliesCount: {
            type: Number
        }
    },

    data() {
        return {
            repliesCount: this.initialRepliesCount
        }
    },

    methods: {
        decreaseCount() {
            console.log("reacting")
            this.repliesCount--;
        }
    }
}
</script>
