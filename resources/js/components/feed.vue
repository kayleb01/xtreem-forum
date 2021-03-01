<template>
    <div>
        <div class="sticky top-0 items-center justify-between bg-white border-gray-400">
            <h2>FEED</h2>
            <div class="bg-gray-500">
                <span v-for="feed in feeds.data" :key="feed.id">
                    <h2>{{feed.title}}</h2>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
        data(){
            return {
                feeds:''
            };
        },

        created(){
            this.getFeed();
        },

        methods:{
            getFeed(){
               axios.get('/feed')
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
