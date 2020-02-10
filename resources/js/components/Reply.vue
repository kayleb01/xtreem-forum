<template>
    <div :id="'comment-'+id" class="panel panel-body">
        <div class="dropdown float-right mr-2" v-if="signedIn">
            <button class=" btn btn-flat dropdown-toggle" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="dropdownMenuButton">
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
               
                <a href="#" class="btn btn-danger-xs btn-sm dropdown-item" @click="destroy" style="color:red !important;"  v-if="signedIn && reply.user.id == user.id || signedIn && user.role == 1"><i class="fa fa-trash"></i> Delete</a>
                <a  class="dropdown-item" :href="'/moderation/'+ reply.user.id + '/ban'">Ban User</a>
            </div>
        </div>
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
                                        <a v-if="signedIn && reply.user.id == user.id || signedIn && user.role == 1"
                                            href="#"
                                            @click.prevent="editing = true"
                                            class="text-black text-xs link ml-4 pl-2 border-l"
                                            >
                                                <i class="fa fa-edit" title="Edit"></i>
                                        </a>
                                        <a  @click="replyShow" class="ml-4 pl-3 bg-color-black" title="Reply" v-show="reply.reply_children != 5"> 
                                            <i class="fa fa-share-square"></i>
                                        </a>
                                        <ReportModal :thread="reply.thread.id" :comment="reply.id"/>
                                         
                                </div>
                            </div>
                            <div class="bg-gray p-2" v-if="reply.reply_children !=''">             
                               <div class="panel-body">
                                   <span><button type="button" @mouseover.once="getReply" class="text-sm btn btn-flat btn-block"  @click="childShow"><small>See more replies</small></button></span>
                                   
                                                <div v-for="replyChildren in items" :key="replyChildren.id" v-show="child" style="padding-bottom:5px;">
                                                    <table  > 
                                                        <tr>
                                                            <td >
                                                            <img :src="'/storage/storage/img/' + replyChildren.user.avatar"
                                                            :alt="replyChildren.user.username"
                                                            width="36"
                                                            height="36"
                                                            class="image-child responsive">
                                                                <span class=" text-black">
                                                                    <a class="font-weight-bold text-black "  :href="'/user/' + replyChildren.user.username" v-text="replyChildren.user.username"></a> &sdot;<span class="text-muted">{{replyChildren.created_at}}</span>
                                                                </span><br/>
                                                            <div class="replyChild-body ">
                                                                {{replyChildren.body}}
                                                            </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            
                               </div>
                               
                             </div> 
                    </div>
                </div>
            </div>
            <ReplyChild v-show="replyClick" :reply="this.reply.id" @created="add"/>
        </div>
</template>

<script>
import Favorite from "./Favorite.vue";
import highlight from "./Highlight.vue";
import moment from "moment";
import collection from "../mixins/collection";

export default {
    props: ["reply"],   
    mixins: [collection],
    components: { Favorite, highlight },
   
    data() {
        return {
            editing: false,
            id: this.reply.id,
            body: this.reply.body,
            replyClick:false,
            child: false,
            dataSet:""
            
        };
    },

    computed: {
        ago() {
            return moment(this.reply.created_at).fromNow() ;
        },
      
    },

  
    methods: {
         replyShow(){
            this.replyClick = !this.replyClick;
        },
         childShow(){
            this.child = !this.child;
        },
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

        getReply() {
        this.fetch();
        },

        destroy() {
            axios.delete("/xf/destroy/" + this.id + "/comment" );

            this.$emit("deleted", this.id);
        },

         fetch() {
            axios.get(this.url()).then(this.refresh);
        },

        url() {
            return `replychild/${this.reply.id}`;
        },

        refresh({ data }) {
            this.dataSet = data;
            this.items = data.data;

            // window.scrollTo(0, 0);
        }
    }
    
}
</script>
