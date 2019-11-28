<template>
    <div :id="'reply-'+id" class="panel panel-body">
        <div class="flex" style="padding:5px;">
            <div class="thread-user" style="margin-left:-63px; margin-top:-8px">
                <img :src="'/storage/storage/img/' + reply.user.avatar"
                     :alt="reply.user.username"
                     width="36"
                     height="36"
                     class="image-circle responsive">
            </div>

            <div class="flex-1 ml-1">
                <div class="flex items-center mb-6 mt-2">
                    <div class="flex flex-1">
                        <span class=" text-black">
                            <a class="font-weight-bold text-black "  :href="'/user/' + reply.user.username" v-text="reply.user.username"></a> &sdot;<span class="text-muted">{{ago}}</span>
                        </span>

                        <a v-if="signedIn && reply.user.id == user.id"
                           href="#"
                           @click.prevent="editing = true"
                           class="text-blue text-xs link ml-2 pl-2 border-l"
                        >
                            Edit
                        </a>
                    </div>

                    
                </div>

                <div class="mb-4">
                    <div v-if="editing">
                        <form @submit.prevent="update">
                            <div class="mb-4">
                                <wysiwyg v-model="body"></wysiwyg>
                            </div>

                            <div class="flex justify-between">
                                <button class="btn bg-red" @click="destroy">Delete</button>

                                <div>
                                    <button class="btn mr-2" @click="cancel" type="button">Cancel</button>
                                    <button type="submit" class="btn bg-blue">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-else>
                        <highlight :content="body"></highlight>
                        <div v-if="signedIn" class="text-xs pl-1" style="padding-top:8px">
                    <favorite :reply="reply"></favorite>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Favorite from "./Favorite.vue";
import Highlight from "./Highlight.vue";
import moment from "moment";

export default {
    props: ["reply"],

    components: { Favorite, Highlight },

    data() {
        return {
            editing: false,
            id: this.reply.id,
            body: this.reply.body,
            
        };
    },

    computed: {
        ago() {
            return moment(this.reply.created_at).fromNow() ;
        },
    },


    methods: {
        update() {
            axios
                .patch("/commentEdit/" + this.id, {
                    body: this.body
                })
                .catch(error => {
                    flash(error.response.data, "danger");
                });

            this.editing = false;

            flash("Updated!");
        },

        cancel() {
            this.editing = false;

            this.body = this.reply.body;
        },

        destroy() {
            axios.delete("/replies/" + this.id);

            this.$emit("deleted", this.id);
        },
    }
};
</script>
