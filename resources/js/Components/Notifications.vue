<template>
    <div class="notifications">
        
    </div>
</template>
<script>
    // import vue from 'Vue';
    // import notification from '../Components/Notification';
    import vue from 'vue'

    export default {
        data: function() {
            return {

            }
        },

        created() {
            this.$root.$refs.Notifications = this;
        },

        methods: {
            addNotification: function(msg, type, timedDisplay) {
                // var notificationClass = vue.extend(notification)
                // var notificationInstance = new notificationClass();

                // notificationInstance.$mount() // pass nothing
                // this.$refs.notifications.appendChild(notificationInstance.$el);
                console.log(msg);
            },

            closeNotification: function() {

            }
        }
    }
</script>