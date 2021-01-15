<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
                        <textarea
                            name="body"
                            id="body"
                            class="form-control mt-4"
                            placeholder="Have something to say"
                            v-model="body"
                            rows="5">
                        </textarea>
            </div>
            <button type="submit" class="btn btn-primary" @click="addReply">Post</button>
        </div>
        <p class="center" v-else>
            Please <a href="/login"> sign in to participate in this discussion</a>
        </p>
    </div>
</template>

<script>
export default {
    props: {
        endpoint: String
    },
    data() {
        return {
            body: ''
        }
    },
    computed: {
        signedIn() {
            return window.App.signedIn
        }
    },
    methods: {
        addReply() {
            axios.post(this.endpoint, {body: this.body})
                .then(response => {
                    this.body = ''
                    flash('New reply has been added')
                    this.$emit('created', response.data)
                })
        }
    }
}
</script>
