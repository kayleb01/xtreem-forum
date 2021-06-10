<template>
    <div  class="panel panel-body bg-light rounded">
        <div class="dropdown float-right d-inline" v-if="signedIn && reply.user.id === user.id || signedIn && user.isAdmin == true">
            <button class=" btn btn-flat dropdown-toggle" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="dropdownMenuButton">
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="#" class="btn btn-danger-xs btn-sm dropdown-item" @click="destroy" style="color:red !important;"  v-if="signedIn && reply.user.id == user.id || signedIn && user.role == 1"><i class="fa fa-trash"></i> Delete</a>
                <a  class="dropdown-item" :href="'/moderation/'+ reply.user.id + '/ban'" v-if="user.role === 1 || user.role === 2">Ban User</a>
            </div>
        </div>
        <div class="pt-2" style="padding:5px;">
            <div class="thread-user" style="margin-left:-63px; margin-top:-8px">
                <table>
                    <tr>
                    <td>
                    <img :src="'/storage/img/'+ (reply.user.avatar ? reply.user.avatar : 'default.jpg')"
                     alt="See mee"
                     width="36"
                     height="36"
                     class="image-circle responsive">
                        <span class=" text-black">
                            <a class="font-weight-bold text-black text-md"  :href="'/u/' + reply.user.username" v-text="reply.user.username"></a> &sdot;<span class="text-muted text-sm"> {{humanTime(reply.created_at)}}</span>
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
                            <div class="row no-gutters" v-if="reply.media.length > 0">
                                <div class="col-3 p-2" v-for="(media, index) in reply.media" :key="index">
                                    <span class="media" style="overflow:hidden">
                                        <button type="button" @click="removeImg(index, media)" class="m-1 top-0 left-0 absolute text-light bg-black opacity-50 text-xs rounded-full cusor-pointer hover:opacity-100 p-1" title="Remove Image">x</button>
                                        <img :src="media.ImageUrl" alt="image">
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-content-center">
                                    <button class="btn mr-2" @click="cancel" type="button"><i class="fa fa-power-off" style="color: red;"></i> Cancel</button>
                                   <button type="submit" class="btn btn-outline-flat"><i class="fa fa-check"></i>Update</button>
                            </div>
                        </form>
                    </div>
                    <div v-else>
                        <highlight :content="body" class="panel-body"></highlight>
                            <div v-if="reply.media.length != 0">
                                <span v-if="reply.media.length == 1" class="grid gap-2 p-2 block">
                                     <img :src="reply.media[0].ImageUrl" class="rounded-lg lazy" >
                                </span>
                                <div class="" v-else>
                                  <splide :options="options" class="grid gap-2 p-2 block " >
                                        <splide-slide v-for="mdia in reply.media" :key="mdia.id" >
                                            <img :src="mdia.ImageUrl" class="rounded-lg lazy" style="object-fit: cover !important; ">
                                        </splide-slide>
                                    </splide>
                                </div>

                            </div>
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
                                        <ReportModal :thread="reply.thread.id" :reply="reply.id" class="ml-5 pl-3" /><br><br>
                                </div>
                            </div>
                            <div v-show="reply.reply_children.length > 0 ||items.length > 0" class="mt-2">
                                <div class="panel-body border-t">
                                    <span>
                                        <button type="button" @mouseover.once="getReply" class="text-sm btn btn-flat btn-block"  @click="childShow" :class="loading ? 'loader' : ''" :disabled="loading">
                                            <small>{{see}}</small>
                                        </button>
                                    </span>
                                    <div v-for="(replyChildren) in items" :key="replyChildren.id" v-show="child" style="padding-bottom:2px;" class="mb-1 chld">
                                       <div @destroyed="destroy(indexes)" >
                                            <span v-if="signedIn && replyChildren.user.id === user.id ">
                                                <a href="#" @click.prevent="childDestroy(replyChildren.id)">
                                                    <i class="fa fa-trash float-right mr-2" style="color:red;"> </i>
                                                </a>
                                            </span>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <img :src="'/storage/img/' + (replyChildren.user.avatar ? replyChildren.user.avatar  : 'default.jpg')"
                                                                :alt="replyChildren.user.username"
                                                                width="36"
                                                                height="37"
                                                                class="image-child responsive"
                                                            >
                                                            <span class=" text-black">
                                                                <a class="font-weight-bold text-black text-xs"  :href="'/u/' + replyChildren.user.username" v-text="replyChildren.user.username"></a> &sdot; <small class="text-muted text-xs"> {{humanTime(replyChildren.created_at)}}</small>
                                                            </span><br/>
                                                            <div class="replyChild-body">
                                                                <small><highlight :content="replyChildren.body"></highlight></small>
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
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/splide/dist/css/themes/splide-default.min.css';

export default {
    props: {
        reply: Object
    },
    mixins: [collection],
    components: {
        Favorite,
        highlight,
        Splide,
        SplideSlide,
        },

    data() {
        return {
            editing: false,
            id: this.reply.id,
            body: this.reply.body,
            replyClick:false,
            child: false,
            loading: false,
            see:"See more replies",
            options: {
                rewind : true,
                width  : 800,
                gap    : '1rem',
                },
            // items: []
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
              this.$swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete a reply, cannot be undone',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText: 'Yes, delete!',
                cancelButtonText:'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if(result.isConfirmed){
                axios
                    .delete("/replychildren/" + id);
                    this.$emit("destroyed", id);
                    this.getReply();
            }else if(
                    result.dismiss === this.$swal.DismissReason.cancel
                ){
                    this.$swal.fire(
                        'Cancelled'
                    )
                }
            })
        },
        cancel() {
            this.editing = false;

            this.body = this.reply.body;
        },

        getReply() {
        this.fetch();
        },

        destroy() {
             this.$swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete a reply, cannot be undone',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText: 'Yes, delete!',
                cancelButtonText:'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if(result.isConfirmed){

            axios.delete("/xf/destroy/" + this.id + "/comment" );

            this.$emit("deleted", this.id);

            }else if(
                    result.dismiss === this.$swal.DismissReason.cancel
                ){
                    this.$swal.fire(
                        'Cancelled'
                    )
                }
            })
        },

         fetch() {
            axios.get(this.url())
            .then(this.refresh)
            .catch(err => {
                this.flashMessage.error({error:"Error fetching resources"})
                });
        },

        url() {
            return `replychild/${this.reply.id}`;
        },

        refresh({ data }) {
            this.dataSet = data;
            this.items = data.data;

            // window.scrollTo(0, 0);
        },

        removeImg(index, item){
            this.$swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete an image, cannot be undone',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText: 'Yes, delete!',
                cancelButtonText:'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if(result.isConfirmed){
                     this.reply.media.splice(index, 1);
                    if(item.id){
                        axios.delete(`/media/${item.id}`)
                        .catch(err => {console.log(err)
                        this.reply.media.splice(index, 0, item)
                        })
                    }
                    this.$swal.fire(
                        'Image deleted!',
                    )
                }else if(
                    result.dismiss === this.$swal.DismissReason.cancel
                ){
                    this.$swal.fire(
                        'Cancelled'
                    )
                }
            })

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
