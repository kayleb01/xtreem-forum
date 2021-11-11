<template>
    <div>
        <div class="top-0" v-for="feed in feeds.data" :key="feed.id">
            <feed-thread :feed="feed"/>
            <comment-thread :feed="feed"/>

        </div>
    </div>
</template>

<script>
import CommentThread from './CommentThread.vue';
import FeedThread from './FeedThread.vue';
export default {
  components: { FeedThread, CommentThread },
        data(){
            return {
                feeds:''
            };
        },

        mounted(){
            this.getFeed();
        },

        methods:{
            getFeed(){
               axios.get('/feed', {
                   Headers:{
                       "Accept":"application/json",
                       "Content-Type":"application/json"
                   }
               })
               .then(({data}) => this.feeds = data)
               .catch(error => {
                this.flashMessage.error ({
                       message: "An Unexpected error occured. Please try again."+ error,
                       });

                })
            }
        }
}
</script>
