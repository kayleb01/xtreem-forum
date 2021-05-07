<template>
    <div>
       <at-ta :members="usersat">
            <textarea :name="name" v-model="value" placeholder="Type a reply..."
                class="editor w-full text-md rounded mt-3 p-2 resize-none outline"
                id="body" required>
            </textarea>
        </at-ta>
    </div>
</template>

<script>
    import AtTa from 'vue-at/dist/vue-at-textarea';

    export default {

        props: ['name', 'value', 'placeholder'],
        components:{
            AtTa
            },

        data(){
            return {
                usersat:[]
            }
        },
        methods: {
            change({target}) {
                this.$emit('input', target.value)
            },
            getUsers(){
            axios.post('api/users')
            .then( ( {data} ) => {
                this.usersat = data
            })
            .catch(err => console.log(errs ))
        }

        },


    }
</script>

<style scoped>
trix-editor {
    min-height: 100px;
}
</style>

