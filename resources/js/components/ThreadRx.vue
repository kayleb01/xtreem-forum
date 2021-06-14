<template>
    <div class="d-flex justify-content-center mt-2">
        <thread-favorite :thread="thread" class="mr-4"></thread-favorite>
            <a v-if="thread.user.id == user.id || user.role == 1"
                :href="'/thread/' + thread.id +'/edit'"
                class="text-black link pl-3 mr-4"
                >
                   <i class="fa fa-edit" title="Edit"></i>
            </a>
            <a href="#reply" class="ml-4 pl-3 bg-color-black" title="Reply">
                <i class="fa fa-share-square"></i>
            </a>
        <report-modal :thread="thread.id" :thread_id="thread.id" class="ml-5 pl-3" /><br><br>
    </div>
</template>
<script>
import ThreadFavorite from "./ThreadFavorite.vue";
import ReportModal from './ReportModal.vue';
export default({
    props:{
        thread: Object
    },
    components:{ ThreadFavorite, ReportModal },
    data() {
        return {

        }
    },
})
</script>
