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
                <div class="flex items-center mb-6 mt-n-5">
                    <div class="flex flex-1">
                        <span class=" text-black">
                            <a class="font-weight-bold text-black "  :href="'/user/' + reply.user.username" v-text="reply.user.username"></a> &sdot;<span class="text-muted">{{ago}}</span>
                        </span>
                    </div>

                    
                </div>

                <div class="mb-2">
                    <div v-if="editing">
                        <form @submit.prevent="update">
                            <div class="mb-4">
                                <wysiwyg v-model="body"></wysiwyg>
                            </div>

                            <div class="flex justify-content-between">
                                <button class="btn btn-danger" @click="destroy">Delete</button>

                                <div>
                                    <button class="btn mr-2" @click="cancel" type="button">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-else>
                        <highlight :content="body"></highlight>
                            <div v-if="signedIn" class="text-xs pl-2" style="padding-top:3px">
                                <div class="row justify-content-center">
                                    <favorite :reply="reply"></favorite>
                                        <a v-if="signedIn && reply.user.id == user.id"
                                            href="#"
                                            @click.prevent="editing = true"
                                            class="text-black text-xs link ml-4 pl-2 border-l"
                                            >
                                                <i class="fa fa-edit" title="Edit"></i>
                                        </a>
                                        <a href="#" class="ml-4 pl-3 link">
                                             <i class="fa fa-quote-right"></i>
                                        </a>
                                        <a href="#" class="ml-4 pl-3 bg-color-black"> 
                                            <i class="fa fa-share-square"></i>
                                        </a>

                                </div>
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
