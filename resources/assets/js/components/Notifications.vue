<template lang="html">
  <div class="dropdown-menu dropdown-menu-right">
    <span v-if="notifications==0" class="dropdown-item text-muted">No tiene notificaciones</span>
    <div v-else v-for="notification in notifications" class="d-flex align-items-center dropdown-item">
      <a v-on:click="read(notification, $event)" :href="'/' + notification.data.follower.username" style="color: #212529; text-decoration: none">
        @{{ notification.data.follower.username }} te ha seguido! <span v-if="notification.read_at==null" class="badge badge-success">Nueva</span>
      </a>
      <a v-on:click="deleteNotification(notification, $event)" style="color: #212529" href="#"><span class="far fa-trash-alt fa-lg ml-3"></span></a>
    </div>
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
    },
    deleteNotification: function(notification, event){
      event.preventDefault();
      let _this = this;
      axios.get('/api/deleteNotification/'+notification.id)
          .then(response => {
            _this.getNotifications();
          });
    }
  }
}
</script>
