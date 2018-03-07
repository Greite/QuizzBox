<template>
  <div class="row">
      <h3>Thèmes</h3>
      <div class="row">
        <div v-for="theme in themes"><h4>{{theme.nom}}</h4>
          <div v-for="quizz in theme.quizz">{{quizz.nom}}

          </div>
        </div>
      </div>
  </div>

</template>

<script>

export default {
  name: 'QuizzListe',
  data () {
    return {
      quizz : '',
      themes: [],
      theme : ''
    }
  },
  mounted() {
    window.axios.get('themes').then(response => { 
      this.themes = response.data.themes
    })
  },
  methods: {
  }
}
</script>
<style scoped>
</style>
