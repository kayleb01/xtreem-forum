<template>
    <div>
        <li class="nav-item dropdown">
            <a href="#" class=" nav-link text-light dropdown-toggle" data-toggle="dropdown" id="dropdownNotification" aria-expanded="false" aria-haspopup="true">
                <i class="fa fa-bell fa-x4 "></i>
                <span class="badge badge-danger" v-if="notifications.length > 0">
                  {{notifications.length}}
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownNotification" id="notification-box">
                <div >
                        <small v-for="(notification, index) in notifications"
                            :key="notification.id"
                            :class="index === notifications.length - 1 ? '' : 'mb-4'"
                        >
                            <a :href="notification.data.link"
                                class="text-xs flex items-center pr-1 link dropdown-item message"
                                @click.prevent="markAsRead(notification)"
                            >

                                <span v-text="notification.data.message"></span>
                            </a>
                        </small>
                    <span v-if="! notifications.length" class="small">You have no notification at the moment.</span>
                </div>
            </div>
        </li>
    </div>
</template>

<script>

    import activation from '../mixins/activation';

    export default {

        mixins: [ activation ],

        data() {
            return { notifications: false }
        },

        created() {
            this.fetchNotifications();
        },

        computed: {
            endpoint() {
                return `/user/${window.App.user.username}/notifications`;
            }
        },

        methods: {
            fetchNotifications() {
                axios.get(this.endpoint)
                    .then(response => this.notifications = response.data);
            },

            markAsRead(notification) {
                axios.delete(`${this.endpoint}/${notification.id}`)
                    .then(({data}) => {
                        this.fetchNotifications();

                        document.location.replace(data.link);
                    });
            }
        }
    }
</script>
