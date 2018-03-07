<template>
	<div class="row">
		<ul class="collection with-header">
        <li class="collection-header"><h3>Thèmes</h3></li>
        <li class="collection-item" v-for="theme in themes">
          <h4>{{theme.nom}}</h4>
          <p>{{theme.description}}</p>

      <div class="row" v-for="quizz in theme.quizz">
        <div class="col s12 m3">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">{{quizz.nom}}</span>
            </div>
            <div class="card-action">
              <a href="#">Télécharger</a>
            </div>
          </div>
        </div>
      </div>
          
        </li>
      </ul>
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
