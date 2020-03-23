<template>
    <div>
        <a href="/report"  @click.prevent="$modal.show('report')" class="link ml-4 pl-3"><i class="fa fa-exclamation-triangle"></i> Report</a>
        <modal name="report" height="auto" :adaptive="true">
            <div class="float-right"><button class="btn btn-flat" @click="$modal.hide('report')">X</button></div>
                <div class="container px-10 py-8 p-3">
                    <h2 class="lead align-text-center">Report to Admin</h2>
                    <form class="px-10 py-8" @submit.prevent="sendReport" @keydown="feedback = ''">
                        <div class=" form-group mb-6">
                            <label for="textarea" class="block uppercase font-bold" >Report</label>
                            <textarea name="report" class="form-control" v-model="report" required maxlength="150"></textarea>
                        </div>
                        <div class="flex justify-end items-center form-group">
                            <button type="submit"  class="btn btn-secondary btn-block" style="border-radius: 15px;" :class="loading ? 'loader' : ''" :disabled="loading">Report</button>
                        </div>
                        <div class="mt-6  p-2" v-if="feedback">
                            <span class="text-xs text-dark font-weight-bolder" v-text="feedback"></span>
                        </div>
                    </form>
                </div>
        
        </modal>
    </div>
</template>
<script>
export default {
    props: ["thread", "comment"],
     data() {
        return {
            form: { report: ""},
            feedback: "",
            loading: false,
            report:"",
            isThread:this.thread, 
            isComment:this.comment
           
        };
    },
    
 methods: {

     sendReport(){
         axios
            .post(location.pathname+"/sendReport",
                 { report:this.report, thread: this.isThread, comment: this.isComment})
            .catch(error => {
                    this.flashMessage.error({
                        message:"An internal error occured, please try again later" 
                        });
                })
                .then(({ data }) => {
                    this.hide();
                    this.feedback = " Thank you for sending us this Report, We'll act accordingly"
                    this.flashMessage.success({
                        message: "Thank you for sending us this Report, We'll act accordingly"
                        });

                    this.$emit("created", data);
                });
     },
    show () {
        this.$modal.show('report');
    },
    hide () {
        this.$modal.hide('report');
    }
 }

}
</script>      