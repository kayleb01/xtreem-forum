<template>
    <div :id="'comment-'+id" class="panel panel-body rounded">
        <div class="dropdown float-right" v-if="signedIn">
            <button class=" btn btn-flat dropdown-toggle" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="dropdownMenuButton">
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
               
                <a href="#" class="btn btn-danger-xs btn-sm dropdown-item" @click="destroy" style="color:red !important;"  v-if="signedIn && reply.user.id == user.id || signedIn && user.role == 1"><i class="fa fa-trash"></i> Delete</a>
                <a  class="dropdown-item" :href="'/moderation/'+ reply.user.id + '/ban'" v-if="user.role === 1 || user.role === 2">Ban User</a>
            </div>
        </div>
        <div class="" style="padding:5px;">
            <div class="thread-user" style="margin-left:-63px; margin-top:-8px">
                <table>
                    <tr>
                    <td >
                    <img :src="'/storage/storage/img/'+reply.user.avatar"
                     :alt="reply.user.username"
                     width="36"
                     height="36"
                     class="image-circle responsive">
                        <span class=" text-black">
                            <a class="font-weight-bold text-black "  :href="'/u/' + reply.user.username" v-text="reply.user.username"></a> &sdot;<span class="text-muted">{{humanTime(reply.created_at)}}</span>
                        </span><br/>
                        <div class="timestamp small" style="width: 400px">
                        replying to @{{reply.thread.user.username}}
                     </div>
                    </td>
                    </tr>
                </table>
            </div>
                <div class="mb-2">
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
                        <highlight :content="body" class="panel-body"></highlight>
                            <div v-if="signedIn" class="text-xs pl-2" style="padding-top:3px">
                                <div class="d-flex justify-content-center">
                                    <favorite :comment="reply" class="mr-4"></favorite>
                                        <a v-if="reply.user.id == user.id || user.role == 1"
                                            href="#"
                                            @click.prevent="editing = true"
                                            class="text-black text-xs link  pl-3 mr-4"
                                            >
                                                <i class="fa fa-edit" title="Edit"></i>
                                        </a>
                                        <a  @click="replyShow" class="ml-4 pl-3 bg-color-black" title="Reply" v-show="reply.replyChild_count <= 5"> 
                                            <i class="fa fa-share-square"></i>
                                        </a>
                                        <ReportModal :thread="reply.thread.id" :comment="reply.id" class="ml-5 pl-3"/><br><br>
                                         <div v-if="reply.attachment">
                                            <span v-for="attachment in reply.attachment" :key="attachment.id">
                                            <img :src="'/storage/public/storage/img/'+ attachment.name" class="attachment">    
                                            </span>   
                                         </div>
                                </div>
                            </div>
                            <div  style="border-top: 1px solid #ccc;" v-if="reply.reply_children !=''" class="mt-2">  
                                <div class="panel-body">
                                    <span>
                                        <button type="button" @mouseover.once="getReply" class="text-sm btn btn-flat btn-block"  @click="childShow" :class="loading ? 'loader' : ''" :disabled="loading">
                                            <small>{{see}}</small>
                                        </button>
                                    </span>      
                                    <div v-for="(replyChildren, indexes) in items" :key="replyChildren.id" v-show="child" style="padding-bottom:2px;" class="mb-1 chld">
                                       <div @destroyed="destroy(indexes)" >  
                                            <span v-if="signedIn && replyChildren.user.id === user.id ">
                                                <a href="#" @click.prevent="childDestroy(replyChildren.id)">
                                                    <i class="fa fa-trash float-right mr-2" style="color:red;"> </i>
                                                </a>
                                            </span> 
                                                <table> 
                                                    <tr>
                                                        <td>
                                                        <img :src="'/storage/storage/img/' + replyChildren.user.avatar"
                                                        :alt="replyChildren.user.username"
                                                        width="36"
                                                        height="36"
                                                        class="image-child responsive">
                                                            <span class=" text-black">
                                                                <a class="font-weight-bold text-black "  :href="'/u/' + replyChildren.user.username" v-text="replyChildren.user.username"></a> &sdot;<span class="text-muted">{{humanTime(replyChildren.created_at)}}</span>
                                                            </span><br/>
                                                        <div class="replyChild-body">
                                                            {{replyChildren.body}}
                                                            
                                                        </div>
                                                        </td>
                                                    </tr>
                                                </table>    
                                            
                                        </div>
                                     </div>
                                </div>
                             </div> 
                             <ReplyChild  :reply="reply.id" @created="add" v-show="replyClick"/>
                    </div>
                </div>
            </div>
            
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
            loading: false,
            see:"See more replies"
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
             this.loading = true;
            this.child = !this.child;
            this.see ="";
            this.loading = false;
        
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
                message: 'Updated successfully!'
                });
        },
        childDestroy(id){
            axios
                .delete("/replychildren/" + id);
                this.$emit("destroyed", id); 
                this.getReply();
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
<style  scoped>
.chld{
    overflow: hidden;
    width: 100%;
}
</style>