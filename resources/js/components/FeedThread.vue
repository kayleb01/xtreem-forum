<template>
    <activity-layout>
        <span slot="activity">
            added a&nbsp;<a class="mr-1 text-blue" :href="activity.subject.path"><strong>thread</strong></a>
            {{ humanTime(activity.subject.created_at) }} in:
        </span>

        <div slot="heading" class="text-md font-semibold">
            <a class="text-blue font-bold mb-2" :href="activity.subject.path">"{{ activity.subject.title }}"</a>

            <p class="text-xs text-grey-darkest font-medium mb-1">
                Posted By:
                <a :href="'/user/' + activity.subject.creator.username" class="text-blue">
                    {{ activity.subject.creator.username }}
                </a>
            </p>
        </div>
        <div slot="body">
            <div class="text-grey-darkest leading-loose mb-1 max-h-24 overflow-hidden">
                <div class="ml-2 my-2 pl-4 border-l-2 border-grey-dark">
                    <highlight :content="activity.subject.body.substring(0, 200)"/>
                </div>
            </div>

            <div class="flex items-center py-1 text-xs text-grey-darkest">
                &#8943; <a class="ml-1 text-2xs text-blue" :href="activity.subject.path">more</a>
            </div>
        </div>

        <div slot="badges" class="flex items-center mx-3 mb-3 text-sm">
            <!-- Replies Count Badge -->
            <div v-if="activity.subject.replies_count > 0" class="text-grey-darker text-2xs font-semibold flex items-center mr-4">
               <i class="fa fa-comment-o"></i>

                {{ activity.subject.replies_count }} Replies
            </div>
        </div>
    </activity-layout>
</template>

<script>
import highlight from "./Highlight.vue";

export default {
    components:{highlight},
    props: {
        activity: {
            required: true
        }
    }
};
</script>
