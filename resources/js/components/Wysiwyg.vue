<template>
    <div>
        <input id="trix" type="hidden" :name="name" :value="value" required>

        <textarea

                @change="change"
                :placeholder="placeholder"
                required v-model="name">
        </textarea>
    </div>
</template>

<style lang="scss">

</style>

<script>


    export default {
        props: ['name', 'value', 'placeholder'],

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
        }
    }
</script>

<style scoped>
trix-editor {
    min-height: 100px;
}
</style>

