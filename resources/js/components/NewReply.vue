<template>
    <div class="new-reply" >
        <div v-if="! signedIn">
            <p class="text-center text-sm text-grey-dark">
               <login/>
            </p>
        </div>
        <div v-else-if="! confirmed">
            To participate in this thread, please check your email and confirm your account.
        </div>
        <div v-else id="reply">
            <form action="" enctype="multipart/form-data">

            </form>
            <div class="mb-3">
                <at-ta :members="usersat">
                    <textarea name="body" placeholder="Type a reply..." v-model="body"
                    class="editor w-full text-md rounded mt-3 p-2 resize-none outline-dashed"
                    id="body" required>
                    </textarea>
                </at-ta>
                <div v-if="file.length" class="grid gap-2" :class="{'grid-cols-2':file.length > 1}">
                    <div v-for="(item , index) in file" :key="index" class="relative flex flex-col items-center justify-center">
                        <button @click="removeMedia(index)" class="m-1 top-0 left-0 absolute text-light bg-black opacity-75 rounded-full cusor-pointer hover:opacity-100 p-2" title="Remove Image">x</button>
                        <img :src="item.url" alt="" class="rounded-lg object-cover h-48">
                        <div :class="loading ? 'loader':''" class="absolute bg-black opacity-75 text-white"></div>
                    </div>
                </div>
            </div>
            <image-upload class="mt-2 p-1" @loaded="uploadImages"></image-upload>
            <button type="submit"
                    class="btn btn-outline-secondary btn-block rounded-pill border border-secondary"
                    @click="addReply" :class="loading ? 'loader' : ''" :disabled="loading">Post</button>
        </div>
    </div>
</template>

<script>

import AtTa from 'vue-at/dist/vue-at-textarea';
import ImageUpload from './ImageUpload.vue';

export default {
  components: { ImageUpload, AtTa },

    data() {
        return {
            body: "",
            loading:false,
            usersat:[],
            file: []
        }
    },

    computed: {
        confirmed() {
            return window.App.user.confirmed;
        }
    },

    mounted() {
         $("#body").atwho({
            at: "@",
            delay: 750,
            callbacks: {
                remoteFilter: function(query, callback) {
                    $.get("/api/users", { name: query }, function(
                        usernames
                    ) {
                        this.usersat = usernames;
                    });
                }
            }
        });
    },

    methods: {
        addReply() {
            if(this.body == ""){
                this.flashMessage.error({message:"Your reply cannot be empty"});
            }else{
                this.loading = true;
                axios
                .post(location.pathname + "/create", { body: this.body })
                .catch(error => {
                    this.flashMessage.error({
                        message:"An internal error occured, please try again later"
                        });
                        this.loading = false;
                })
                .then(({ data }) => {
                    this.body = "";

                    this.flashMessage.success({
                        message: "Your reply has been posted."
                        });
                        this.loading = false;

                    this.$emit("created", data);
                });
            }

        },
        uploadImages(files){
            Array.from(files).forEach((media) => {
                 //let file = e.target.files[0];

                let reader = new FileReader();

                reader.readAsDataURL(media);

                reader.onload = e => {
                    let src = e.target.result;

                    let item = {
                        url: e.target.result,
                        // id: undefined,
                        // loading: true

                    };

                    // let formdata = new FormData();
                    // formdata.append('file', media);
                    //  axios.post('/attachment', formdata)
                    //  .then( ({data}) => {
                    //      item.id = data.id
                    //  })
                    //  .finally( () => this.loading = false )

                   this.file.push(item);

                };
            })
        },
        removeMedia(index){
            this.file.splice(index, 1);
        }
    }
};
</script>

<style scoped>
.new-reply {
    background-color: #f9f9f9;
    padding:5px;
}
</style>
