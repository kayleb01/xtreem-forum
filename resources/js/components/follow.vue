<template>
<div>
   
    <button class="btn btn-primary rounded-pill px-3" @click.prevent="follow" v-text="isActive ? 'Unfollow' : 'Follow'"></button>
</div>
</template>

<script>
export default {
    props:['userfollow', 'active'],

    data(){
        return{
            isActive: this.active,
            user:window.App.user,
            follower: this.userfollow
        }
    },
    methods:{
        follow(){
            axios[this.active ? 'get' : 'post']
            ('/user/follow/'+this.follower+'', {user_id: this.user.id, followers_id:this.follower});
            this.isActive = !this.isActive;
            if (this.isActive) {
                this.flashMessage.success({
                   message: "You are now following this user!"
                    });
            }
        }     
    },
}
</script>