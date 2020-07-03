<template>
<div>     
    <div class="p-2">
        <form @submit.prevent="sendChild" method="post">
        <div class="input-group">
            <input type="text" name="replyChild" v-model="ChildReply" maxlength="250" class="form-control form-control-sm bg-gray rounded-left"  placeholder="Quick Reply" style="overflow:auto">
            <div class="input-group-append">
                <button type="submit"  class="btn btn-secondary btn-sm" :class="loading ? 'loader' : ''" :disabled="loading">Reply</button>
            </div>
        </div>
        </form>
    </div>
</div>
</template>

<script>
 import activation from '../mixins/activation';
 import collection from "../mixins/collection";
export default {
    mixins: [ activation ],
    mixins: [collection],
    props:["reply"],


    data(){
        return{
            replyClick:false,
            ChildReply:"",
            loading: false
          
        };
    },
   
    methods:{
       childShow(){
            this.child = !this.child;
        },
       

       sendChild(){
           this.loading = true;
           if(this.ChildReply ==""){
            this.flashMessage.error({message:"Oops! Reply field is empty!"})
           }else{
               
               axios
            .post("/replyChild/"+this.reply, { replyChild:this.ChildReply})
            .catch(
                error => this.flashMessage.error({error: "Reply not sent, an error occured!"  }),
                )
            .then(({data}) => {
                this.ChildReply = "";
                
                 this.flashMessage.success({
                        message: "Reply sent!"
                        });
                    this.loading = false;
                    this.$emit("created", data);

            })
           }
           
       },
       
        childDestroy(){
            axios
                .delete("/replychildren/" + this.replyChildren.id)
                .catch(error =>
                    this.flashMessage.error({message:error})
                );
                this.$emit("deleted", this.reply.id);
                
              
        }
       
    }
}
</script>