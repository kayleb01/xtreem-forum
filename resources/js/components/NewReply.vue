<template>
    <div class="new-reply" >
        <div v-if="! signedIn">
            <p class="text-center text-sm text-grey-dark">
               <login/>
            </p>
        </div>
        <div v-else-if="! confirmed">
            To participate in this thread, please check your email and confirm your account.
        </div>
        <div v-else id="reply">
            <div class="mb-3">
                <at-ta :members="usersat">
                    <textarea name="body" v-model="body" class="editor" id="body" required>
                    </textarea>
                </at-ta>
            </div>
            <image-upload></image-upload>
            <button type="submit"
                    class="btn btn-outline-secondary btn-block rounded-pill border border-secondary"
                    @click="addReply" :class="loading ? 'loader' : ''" :disabled="loading">Post</button>
        </div>
    </div>
</template>

<script>

import AtTa from 'vue-at/dist/vue-at-textarea';
import ImageUpload from './ImageUpload.vue';

export default {
  components: { ImageUpload, AtTa },

    data() {
        return {
            body: "",
            loading:false,
            usersat:[]
        }
    },

    computed: {
        confirmed() {
            return window.App.user.confirmed;
        }
    },

    mounted() {
         $("#body").atwho({
            at: "@",
            delay: 750,
            callbacks: {
                remoteFilter: function(query, callback) {
                    $.get("/api/users", { name: query }, function(
                        usernames
                    ) {
                        this.usersat = usernames;
                    });
                }
            }
        });
    },

    methods: {
        addReply() {
            if(this.body == ""){
                this.flashMessage.error({message:"Your reply cannot be empty"});
            }else{
                this.loading = true;
                axios
                .post(location.pathname + "/create", { body: this.body })
                .catch(error => {
                    this.flashMessage.error({
                        message:"An internal error occured, please try again later"
                        });
                        this.loading = false;
                })
                .then(({ data }) => {
                    this.body = "";

                    this.flashMessage.success({
                        message: "Your reply has been posted."
                        });
                        this.loading = false;

                    this.$emit("created", data);
                });
            }

        }
    }
};
</script>

<style scoped>
.new-reply {
    background-color: #f9f9f9;
    padding:5px;
}
</style>
