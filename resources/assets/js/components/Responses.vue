<template lang="html">
  <div class="container">
    <div class="row">
      <a class="btn btn-outline-primary" href="#" v-on:click="load">Ver respuestas</a>

      <div class="mt-2 col-12" v-for="response in responses">
        <div class="card">
          <div class="card-body">
            {{ response.message }}
          </div>
          <div class="card-footer text-muted">
            {{ response.created_at }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['message'],
  data(){
    return {
      responses: [],
    }
  },

  methods: {
    load(){
      axios.get('/api/message/' + this.message + '/responses')
        .then(res => {
          this.responses = res.data;
        });
    }
  }
}
</script>
