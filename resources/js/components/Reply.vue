<template>
    <div>
        <slot :editing="editing"
              :body="body"
              :cancel="cancel"
              :destroy="destroy"
              :visible="visible"
              :updateBody="updateBody"
              :edit="edit">

        </slot>
    </div>
</template>
<script>
export default {
    name: "Reply",
    props: {
      attributes: {
          type: Object
      }
    },

    data() {
        return {
            editing: false,
            body: this.attributes.body,
        }
    },

    created() {
        console.log("see this component", this.attributes)
    },
    methods: {
        edit() {
            this.editing = true;
        },
        cancel() {
            this.editing = false;
        },
        updateBody(input) {
            const url = `/replies/${this.attributes.id}`
            axios.patch(url, {
                body: input
            })

            this.body = input
            this.editing = false;
            flash('Updated')
        },

        destroy() {
            const url = `/replies/${this.attributes.id}`
            axios.delete(url);

            $(this.$el).fadeOut(300, () => {
                flash('Your reply has been deleted')
            })


        }
    }
}
</script>

<style>

</style>
