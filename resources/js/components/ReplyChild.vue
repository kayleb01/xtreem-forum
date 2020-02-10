<template>
<div>
    <div class="p-2 " >
        <form @submit.prevent="sendChild" method="post">
        <div class="input-group">
            <textarea name="replyChild" v-model="ChildReply" maxlength="250" class="form-control form-control-sm bg-gray rounded-left"  placeholder="Quick Reply" rows="1"></textarea>
            <div class="input-group-append">
                <button type="submit"  class="btn btn-secondary btn-sm">Reply</button>
            </div>
        </div>
        </form>
    </div>
</div>
</template>

<script>
 import activation from '../mixins/activation';
export default {
     mixins: [ activation ],
     props:["reply"],


    data(){
        return{
            ChildReply:""
        };
    },
    computed:{
           endpoint(){
               return ``;
               
           }
       },
    methods:{
       sendChild(){
           axios
            .post("/replyChild/"+this.reply, { replyChild:this.ChildReply})
            .catch(error => this.flashMessage.error({error: "Reply not sent, an error occured!" }))
            .then(({data}) => {
                this.ChildReply = "";
                
                 this.flashMessage.success({
                        message: "Your reply sent!"
                        });

                    this.$emit("created", data);

            })
       },
       
    }
}
</script>