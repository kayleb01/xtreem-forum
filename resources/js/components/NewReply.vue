<template>
    <div class="new-reply" >
        <div v-if="! signedIn">
            <p class="text-center text-sm text-grey-dark">
               <login/>
               <register/>
            </p>
        </div>
        <div v-else-if="! confirmed">
            To participate in this thread, please check your email and confirm your account.
        </div>
        <div v-else id="reply">
            <div class="mb-3">
                <wysiwyg name="body" v-model="body" class="at" id="body" required>
                 
                </wysiwyg>
            </div>

            <button type="submit"
                    class="btn btn-secondary btn-block rounded-pill"
                    @click="addReply">Post</button>
        </div>
    </div>
</template>

<script>
import "jquery.caret";
import "at.js";

export default {
   
    data() {
        return {
            body: ""
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
                    $.getJSON("/api/users", { name: query }, function(
                        usernames
                    ) {
                        callback(usernames);
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
                axios
                .post(location.pathname + "/create", { body: this.body })
                .catch(error => {
                    this.flashMessage.error({
                        message:"An internal error occured, please try again later" 
                        });
                })
                .then(({ data }) => {
                    this.body = "";

                    this.flashMessage.success({
                        message: "Your reply has been posted."
                        });

                    this.$emit("created", data);
                });
            }
            
        }
    }
};
</script>

<style scoped>
.new-reply {
    background-color: #fff;
    padding:5px;
}
</style>
