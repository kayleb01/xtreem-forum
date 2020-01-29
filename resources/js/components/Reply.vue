<template>
    <div :id="'comment-'+id" class="panel panel-body">
        <span class=" float-right mr-2"> <i class=" fa fa-caret-down"></i></span>
        <div class="flex" style="padding:5px;">
            <div class="thread-user" style="margin-left:-63px; margin-top:-8px">
                <table>
                    <tr>
                    <td>
                    <img :src="'/storage/storage/img/' + reply.user.avatar"
                     :alt="reply.user.username"
                     width="36"
                     height="36"
                     class="image-circle responsive">
                        <span class=" text-black">
                            <a class="font-weight-bold text-black "  :href="'/user/' + reply.user.username" v-text="reply.user.username"></a> &sdot;<span class="text-muted">{{ago}}</span>
                        </span><br/>
                        <div class="timestamp small" style="width: 400px">
                        replying to @{{reply.thread.user.username}}
                     </div>
                    </td>
                    </tr>
                </table>
            </div>

                <div class="mb-2 small">
                    <div v-if="editing">
                        <form @submit.prevent="update">
                            <div class="mb-4">
                                <wysiwyg v-model="body" name="body"></wysiwyg>
                            </div>

                            <div class="flex justify-content-center">
                                <button class="btn btn-danger-xs btn-sm" @click="destroy"><i class="fa fa-trash"></i> Delete</button>

                                
                                    <button class="btn mr-2" @click="cancel" type="button"><i class="fa fa-power-off" style="color: red;"></i> Cancel</button>
                                   <button type="submit" class="btn btn-outline-flat"><i class="fa fa-check"></i>Update</button> 
                                
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
                                        <a href="#" @click.prevent="quote()" class="ml-4 pl-3 link">
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
        
  
</template>

<script>
import Favorite from "./Favorite.vue";
import moment from "moment";

export default {
    props: ["reply"],

    components: { Favorite },

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
                    this.flashMessage.error({error:"An Internal Error occured, please try again later"});
                });

            this.editing = false;

            this.flashMessage.success({
                message: 'Updated!'
                });
        },

        cancel() {
            this.editing = false;

            this.body = this.reply.body;
        },

        destroy() {
            axios.delete("/xf/destroy/" + this.id + "/comment" );

            this.$emit("deleted", this.id);
        },

        quote(){
            const body = this.reply.body;
            const quot = `
                    <div class="bbcode_quote">
                    <div class="bbcode_quote_head">@`+this.reply.user.username + `</div>
                    <div class="bbcode_quote_body"> ` + body + `</div>
                    </div>
                            `;
                            console.log(quot);

        }
    }
};
</script>
