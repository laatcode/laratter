<template lang="html">
  <div class="dropdown-menu dropdown-menu-right">
    <span v-if="notifications==0" class="dropdown-item text-muted">No tiene notificaciones</span>
    <a v-on:click="read(notification, $event)" v-for="notification in notifications" :href="'/' + notification.data.follower.username" class="dropdown-item">
      @{{ notification.data.follower.username }} te ha seguido! <span v-if="notification.read_at==null" class="badge badge-success">Nueva</span>
    </a>
    <div class="dropdown-divider"></div>
    <a v-if="notifications!=0" v-on:click="readNotifications" class="dropdown-item" href="#">Marcas todas como leídas</a>
    <a v-on:click="deleteNotifications" class="dropdown-item" href="#">Borrar notificaciones</a>
  </div>
</template>

<script>
export default {
  props: ['user'],
  data(){
    return {
      notifications: []
    }
  },
  mounted(){
    this.getNotifications();

    Echo.private(`App.User.${this.user}`)
        .notification(notification => {
          this.notifications.unshift(notification);
        });
  },
  methods: {
    getNotifications: function(){
      this.notifications = []
      axios.get('/api/notifications')
          .then(response => {
            this.notifications = response.data;
          });
    },
    read: function(notification, event){
      if (notification.read_at==null) {
        let _this = this;
        axios.get('/api/readNotification/'+notification.id)
            .then(response => {
              _this.getNotifications();
            });
      }
    },
    readNotifications: function(event){
      event.preventDefault();
      let _this = this;
      axios.get('/api/readNotifications')
          .then(response => {
            _this.getNotifications();
          });
    },
    deleteNotifications: function(event){
      event.preventDefault();
      let _this = this;
      axios.get('/api/deleteNotifications')
          .then(response => {
            _this.getNotifications();
          });
    }
  }
}
</script>
