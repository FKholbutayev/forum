<template>
    <div class="card bg-white">
        <div :id="'reply-'+id" class="card-header">
            <div class="level">
                <h5 class="flex">
                    <a :href="'/profiles/'+ data.owner.name"
                       v-text="data.owner.name">
                    </a> said
                    {{ data.created_at }} ago
                </h5>

                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>

            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                    <div class="mt-2">
                        <button class="btn btn-sm btn-outline-primary" @click="updateBody(body)">Update</button>
                        <button class="btn btn-sm btn-outline-primary mr-2" @click="cancel">Cancel</button>
                    </div>
                </div>
            </div>
            <div v-else v-text="body"></div>
        </div>

        <div class="card-footer" v-if="canUpdate">
            <button type="submit" class="btn btn-primary btn-sm" @click="edit">Edit</button>
            <button type="submit" class="btn btn-danger btn-sm" @click="destroy">Delete</button>
        </div>
    </div>
</template>
<script>
import Favorite from "./Favorite";

export default {
    name: "Reply",
    props: {
        data: {
            type: Object
        }
    },

    components: {Favorite},

    data() {
        return {
            editing: false,
            body: this.data.body,
            id: this.data.id
        }
    },

    created() {
        console.log("see this component", this.data)
    },
    computed: {
        signedIn() {
            return window.App.signedIn
        },
        canUpdate() {
            return this.authorize(user => this.data.user_id == user.id)
        }
    },
    methods: {
        edit() {
            this.editing = true;
        },
        cancel() {
            this.editing = false;
        },
        updateBody(input) {
            const url = `/replies/${this.data.id}`
            axios.patch(url, {
                body: input
            })

            this.body = input
            this.editing = false;
            flash('Updated')
        },

        destroy() {
            const url = `/replies/${this.data.id}`
            axios.delete(url);

            this.$emit('deleted', this.data.id)


        }
    }
}
</script>

<style>

</style>
