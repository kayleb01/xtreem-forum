<template>
<div class="border-t">
     <input type="file" accept="image/*" @change="onChange" class="hidden" multiple ref="picker" name="upload__files">
     <button type="button" class="inline-flex items-center rouded-full p-2 hover:bg-black-100 text-dark focus:inline-none" @click="browse"><i class="fa fa-lg fa-image fill-current"></i></button>
</div>

</template>

<script>
    export default {
        methods: {
            onChange(e) {
                if (! e.target.files.length) return;
                this.$emit('loaded', e.target.files)
            },
            browse(){
                this.$refs  .picker.click();
            }
        }
    }
</script>
