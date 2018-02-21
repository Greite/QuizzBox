<template>
  <div class="row">
      <h3>Thèmes</h3>
      <div class="row">
        <p v-for="theme in themes">{{theme.nom}}</p>
      </div>
  </div>

</template>

<script>

export default {
  name: 'QuizzListe',
  data () {
    return {
      quizz : [],
      quiz: '',
      themes: [],
      theme : ''
    }
  },
  mounted() {
    window.axios.get('themes').then(response => { 
      this.themes = response.data.themes  
    })
    window.axios.get('quizz').then(response => { 
      this.quizz = response.data.quizz  
    })
  },
  methods: {
  }
}
</script>
<style scoped>
</style>
