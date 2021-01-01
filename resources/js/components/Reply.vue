<template>
    <div>
        <slot :editing="editing"
              :body="body"
              :cancel="cancel"
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
            body: this.attributes.body
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
        updateBody() {
            const url = `/replies/${this.attributes.id}`
            console.log("this body", this.body)
            console.log("attribite boyd", this.attributes.body)
           /* axios.patch(url, {
                body: this.body
            })*/

           // this.editing = false;
        }
    }
}
</script>

<style>

</style>
