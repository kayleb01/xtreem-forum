<template>
    <div>
       <form  enctype="multipart/form-data">
            <div class="mb-3 ml-2 mr-2">
                <at-ta :members="usersat">
                    <textarea
                        :name="name"
                        :value="value"
                        class="editor w-full text-md rounded mt-3 p-2 resize-none outline"
                        id="body"
                        :placeholder="placeholder"
                        @change="change"
                        required
                    >
                    </textarea>
                </at-ta>
            </div>
        </form>

    </div>
</template>

<script>
import AtTa from 'vue-at/dist/vue-at-textarea';


    export default {
        components: { AtTa },
        props: ['name', 'value', 'placeholder'],

        data(){
            return{
            usersat:[],

            }
        },

        methods: {
            change({target}) {
                this.$emit('input', target.value)
            }
        },

        watch: {
            value(val) {
                if (val === '') {
                    this.$refs.trix.value = '';
                }
            }
        },

        getUsers(){
            axios.post('api/users')
            .then( ( {data} ) => {
                this.usersat = data
            })
            .catch(err => console.log(errs ))
        },
    }
</script>

<style scoped>
textarea {
    min-height: 100px;
}
</style>

