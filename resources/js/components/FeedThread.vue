<template>
<div>
    <div class="bg-gray-500">
        <div class="flex bg-light p-2 rounded-lg">
            <div class="flex-shrink-0 h-12 w-14">

                <img class=" h-12 rounded-lg sm:mx-0 sm:flex-shrink-0" loading="lazy" :src="'/storage/img/'+ (feed.user.avatar ? feed.user.avatar :'default.jpg')" :alt="feed.user.username">
            </div>
            <div class="ml-1">
                <div class="text-sm font-semibold text-grey-dark" v-show="feed.user.username != user.username" >
                   <svg id="Capa_1" enable-background="new 0 0 512 512" height="12" viewBox="0 0 512 512" width="12" xmlns="http://www.w3.org/2000/svg"><g><path d="m271 60-30 16.8 30 13.2v30l-30 13.5 30 16.5v30l-30 14.7 30 15.3v105h-180v-105l30-14.7-30-15.3v-30l30-15-30-15v-30l30-16.201-30-13.799v-45h180z" fill="#d1b3ff"/><g fill="#b799ff"><path d="m271 60-30 16.8 30 13.2v30l-30 13.5 30 16.5v30l-30 14.7 30 15.3v105h-90v-300h90z"/><path d="m91 180h180v30h-180z"/><path d="m91 120h180v30h-180z"/><path d="m91 60h180v30h-180z"/></g><g><path d="m361 375c0 8.399-6.599 15-15 15h-300c-8.401 0-15-6.601-15-15 0-8.401 6.599-15 15-15h300c8.401 0 15 6.599 15 15z" fill="#eff6ff"/></g><g><path d="m301 315c0 8.399-6.599 15-15 15h-210c-8.401 0-15-6.601-15-15 0-8.401 6.599-15 15-15h210c8.401 0 15 6.599 15 15z" fill="#554d99"/></g><g><path d="m301 15c0 8.399-6.599 15-15 15h-210c-8.401 0-15-6.601-15-15 0-8.401 6.599-15 15-15h210c8.401 0 15 6.599 15 15z" fill="#554d99"/></g><g><path d="m466 512h-30c-41.353 0-75-33.647-75-75v-32c0-8.291 6.709-15 15-15s15 6.709 15 15v32c0 24.814 20.186 45 45 45h30c8.291 0 15 6.709 15 15s-6.709 15-15 15z" fill="#9b80ff"/></g><path d="m301 315c0 8.399-6.599 15-15 15h-105v-30h105c8.401 0 15 6.599 15 15z" fill="#373366"/><path d="m286 30h-105v-30h105c8.401 0 15 6.599 15 15 0 8.399-6.599 15-15 15z" fill="#373366"/><path d="m181 60h90v30h-90z" fill="#9b80ff"/><path d="m181 120h90v30h-90z" fill="#9b80ff"/><path d="m181 180h90v30h-90z" fill="#9b80ff"/><path d="m361 375c0 8.399-6.599 15-15 15h-165v-30h165c8.401 0 15 6.599 15 15z" fill="#d9ebff"/><path d="m376 330c-24.814 0-45 20.186-45 45s20.186 45 45 45 45-20.186 45-45-20.186-45-45-45z" fill="#d9ebff"/><path d="m391 315v60c0 8.399-6.599 15-15 15s-15-6.601-15-15v-60c0-24.901-20.099-45-45-45h-225v-30h225c41.4 0 75 33.6 75 75z" fill="#b799ff"/><path d="m391 315v60c0 8.399-6.599 15-15 15s-15-6.601-15-15v-60c0-24.901-20.099-45-45-45h-135v-30h135c41.4 0 75 33.6 75 75z" fill="#9b80ff"/></g></svg>
                    {{feed.user.username}} created a thread {{humanTime(feed.created_at)}}
                </div>
               <!-- <span v-for="comment in feed.comment" :key="comment.id">

                   {{comment.body}}
               </span> -->
            <div class="">
                <span class="font-weight-bold text-blue-900"><a :href="feed.path">{{feed.title}}</a></span>
                <highlight class="text-sm" :content="feed.body.split(' ').splice(0, 20).join(' ')+'...'"></highlight>
                <span><a :href="feed.path" class="text-xs link">Read more</a></span>
            </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import highlight from "./Highlight.vue";

export default {
    props:['feed'],
    components:{highlight},


};
</script>
