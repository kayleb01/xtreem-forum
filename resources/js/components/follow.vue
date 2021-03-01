<template>
<div>
    <flashMessage></flashMessage>
    <button class="btn btn-primary rounded-pill px-3" @click.prevent="follow" v-text="isActive ? 'Following' : 'Follow'"></button>

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
            let req
            if (this.isActive) {
                 req = {follower_id: this.user.id, followed_id:this.follower, '_method':'delete'}
            } else {
                 req = {follower_id: this.user.id, followed_id:this.follower}
            }

            axios[this.active ? 'get' : 'post']
            ('/u/' + this.user.username + '/follow/'+this.follower+'', req );
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
