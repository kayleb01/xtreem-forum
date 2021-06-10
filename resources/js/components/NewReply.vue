<template>
    <div class="new-reply" id="reply">
        <div v-if="! signedIn" class="mb-4">
            <p class="text-center text-sm text-grey-dark">
               <a href="/login">Login</a>  to participate in this thread
            </p>
        </div>
        <div v-else-if="! confirmed">
            To participate in this thread, please check your email and confirm your account.
        </div>
        <div v-else id="reply">
            <form  enctype="multipart/form-data">
                <div class="mb-3 ml-2 mr-2">
                    <at-ta :members="usersat">
                        <textarea name="body" placeholder="Type a reply..." v-model="form.body"
                            class="editor w-full text-md rounded mt-3 p-2 resize-none outline"
                            id="body" required>
                        </textarea>
                    </at-ta>
                    <div v-if="file.length" class="grid gap-2" :class="{'grid-cols-2':file.length > 1}">
                        <div v-for="(item , index) in file" :key="index" class="relative">
                            <button type="button" @click="removeMedia(index, item)" class="m-1 top-0 left-0 absolute text-light bg-black opacity-75 rounded-full cusor-pointer hover:opacity-100 p-2" title="Remove Image">x</button>
                            <img :src="item.url" alt="" class="rounded-lg object-cover h-48">
                            <div :class="loading ? 'loader':''" class="absolute bg-black opacity-75 text-white"></div>
                        </div>
                    </div>
                </div>
                <image-upload class="mt-2 p-1" @loaded="uploadImages"></image-upload>
                <button type="submit"
                    class="btn btn-outline-secondary btn-block rounded-pill border border-secondary"
                    @click="addReply" :class="loading ? 'loader' : ''" :disabled="loading"
                    >
                    Post
                </button>
            </form>
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
            form:{body:'', imageIds: []},
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
        //
        this.getUsers()
    },

    methods: {
        addReply() {
            if(this.form.body == "" && this.form.imageIds == ""){
                this.flashMessage.error({message:"Your reply cannot be empty"});
            }else{
                this.loading = true;
                this.form.imageIds = this.file.map( (item) => item.id)
                axios
                .post(location.pathname + "/create", this.form, { preserveState: true,
                    onStart: ()  => this.loading = true,
                    onFinish: () => this.loading = false,
                    onSuccess: () => {
                        if(Object.keys(this.$page.props.errors.length === 0)){
                            this.form = {content:'', imageIds: []};
                            this.file = [];
                        }
                    },

                })
                .catch(error => {
                    this.flashMessage.error({
                        message:"An internal error occured, please try again later"
                        });
                        this.loading = false;
                })
                .then(({ data }) => {
                    this.form.body = "";
                    this.file = []

                    this.flashMessage.success({
                        message: "Your reply has been posted."
                        });
                        this.loading = false;

                    this.$emit("created", data);
                });
            }
        },

        getUsers(){
            axios.post('api/users')
            .then( ( {data} ) => {
                this.usersat = data
            })
            .catch(err => console.log(err))
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
                        id: undefined,
                        loading: true
                    };

                    let formdata = new FormData();
                    formdata.append('file', media);

                     axios.post('/media', formdata)
                     .then( ({data}) => {
                         item.id = data.id
                     })
                     .catch(err => console.log(err))
                     .finally( () => this.loading = false )

                   this.file.push(item);

                };
            })
        },
        removeMedia(index, item){
            this.file.splice(index, 1);
            if(item.id){
                axios.delete(`/media/${item.id}`)
                .catch(err => {console.log(err)
                this.file.splice(index, 0, item)
                })

            }
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
