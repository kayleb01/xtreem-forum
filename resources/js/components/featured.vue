<template>
<div>
    <button v-for="(tab, index) in tabs" :key="index" :class="{ active: selectedTab === tab}" id="tablinks"
    @click="selectedTab = tab"
    > {{ tab }}</button>
</div>
    
</template>

<script>
    export default {
        data(){
            return {
               tabs: ['Featured', 'Trending'],
               selectedTab: 'Featured'
            }
        }

    }
</script>
