<template>
    <div>
        <slot :repliesCount="repliesCount"
              :increaseCount="increaseCount"
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
            this.repliesCount--
        },
        increaseCount() {
            this.repliesCount++
        }
    }
}
</script>
