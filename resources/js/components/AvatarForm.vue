<template>
    <div>
        <div class="level">
            <img :src="avatar" width="50" height="50" class="mr-1">

            <h1>
                {{ user.username }}
                
            </h1>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <image-upload name="avatar" class="mr-1" @loaded="onLoad"></image-upload>
        </form>

    </div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue';

    export default {
        props: ['user'],

        components: { ImageUpload },

        data() {
            return {
                avatar: this.user.avatar
            };
        },

        computed: {
          

        },

        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src;

                this.persist(avatar.file);
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`/api/users/${this.user.username}/avatar`, data)
                    .then(() => flash('Avatar uploaded!'));
            }
        }
    }
</script>
