<template>
    <div style="text-align:center;">
        
    <a href="#" style="max-width:auto;"  :class="isActive ? 'font-weight-bold': ''" @click.prevent="subscribe" v-text="isActive ? '(Subscribed)' : '(Subscribe)'"></a>
   
    </div>
</template>

<script>
export default {
    props: ["active", "threads"],

    data() {
        return {
            isActive: this.active,
            id: this.threads
            
        };
    },

    methods: {
        subscribe() {
            axios[this.isActive ? "delete" : "get"](
                "xf/"+ this.id + "/subscriptions"
            );
            this.isActive = !this.isActive;
            if (this.isActive) {
                this.flashMessage.success({
                   message: "Okay, we'll notify you when this thread is updated!"
                    });
            }
        }
    }
};
</script>
