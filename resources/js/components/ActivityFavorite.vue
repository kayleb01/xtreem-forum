<template>
    <activity-layout>
        <span slot="activity">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 20 19" class="fill-current">
                    <g fill="none" fill-rule="evenodd">
                        <path d="M-2-3h24v24H-2z"/>
                        <path fill="rgb(250, 7, 7)" d="M14.5 0c-1.74 0-3.41.81-4.5 2.09C8.91.81 7.24 0 5.5 0 2.42 0 0 2.42 0 5.5c0 3.78 3.4 6.86 8.55 11.54L10 18.35l1.45-1.32C16.6 12.36 20 9.28 20 5.5 20 2.42 17.58 0 14.5 0z"/>
                    </g>
                </svg>
           Liked a comment 
            {{ humanTime(activity.likableModel.created_at) }} in:
        </span>

        <div slot="heading" class="text-md font-semibold ">
            <a class="text-blue font-bold mb-2" :href="activity.likableModel.path">"{{ activity.likableModel.thread.title }}"</a>

            <p class="text-xs text-grey-darkest font-medium mb-4">
                Posted By: <a :href="activity.likableModel.thread.creator.username" class="text-blue">{{
                activity.likableModel.thread.creator.username }}</a>
            </p>
        </div>

        <div slot="body">
            <div class="text-grey-darkest leading-loose mb-4 max-h-24 overflow-hidden">
                <div class="ml-6 my-4 pl-4 border-l-2 border-grey-dark">
                    <highlight :content="activity.likableModel.body"/>
                </div>
            </div>

            <div class="flex items-center py-1 text-xs text-grey-darkest">
                &#8943; <a class="ml-1 text-2xs text-blue" :href="activity.likableModel.path">more</a>
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
