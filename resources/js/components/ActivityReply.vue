<template>
    <activity-layout class="">
        {{activity.subject}}
        <span slot="activity" class="bg-light">
            added a&nbsp;<a class="mr-1 text-blue font-bold" :href="activity.subject.path">reply</a>
            {{ humanTime(activity.subject.created_at) }} in:
        </span>
        <div slot="heading" class="text-md font-semibold ">
            <a class="text-blue font-bold mb-2" :href="activity.subject.thread.path">"{{ activity.subject.thread.title }}"</a>

            <p class="text-xs text-grey-darkest font-medium mb-2">
                Posted By: <a :href="activity.subject.thread.creator.username" class="text-blue">{{
                activity.subject.thread.creator.username }}</a>
            </p>
        </div>

        <div slot="body">
            <div class="text-grey-darkest leading-loose mb-2 max-h-24 overflow-hidden">
                <div class="ml-3 my-2 pl-4 border-l-2 border-grey-dark">
                    <highlight :content="activity.subject.body"/>
                </div>
            </div>

            <div class="flex items-center py-1 text-xs text-grey-darkest">
                &#8943; <a class="ml-1 text-2xs text-blue" :href="activity.subject.path">more</a>
            </div>
        </div>

        <div slot="badges" class="flex items-center mx-6 mb-6 text-sm" v-if="activity.subject.likesCount">
            <!-- Favorites Badge -->
            <div class="text-2xs flex items-center mr-2 text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 20 19" class="fill-current">
                    <g fill="none" fill-rule="evenodd">
                        <path d="M-2-3h24v24H-2z"/>
                        <path fill="rgb(250, 7, 7)" d="M14.5 0c-1.74 0-3.41.81-4.5 2.09C8.91.81 7.24 0 5.5 0 2.42 0 0 2.42 0 5.5c0 3.78 3.4 6.86 8.55 11.54L10 18.35l1.45-1.32C16.6 12.36 20 9.28 20 5.5 20 2.42 17.58 0 14.5 0z"/>
                    </g>
                </svg>

                <span class="text-grey-darker text-2xs font-semibold  ml-1">{{ activity.subject.likesCount }} Like(s)</span>
            </div>
        </div>
    </activity-layout>
</template>

<script>
export default {
    props: {
        activity: {
            required: true
        }
    }
};
</script>
