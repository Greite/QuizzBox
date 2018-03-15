<template>
	<div class="row">

		<div class="row col s3">
			<label >Rechercher un thème</label>
			<select id="selected" v-model="selected" class="browser-default">
				<option v-for="theme in themes" v-bind:value="theme.id">{{theme.nom}}</option>
			</select>
		</div>
		<div class="row col s12" v-for="theme in themes" v-if="theme.id == selected">
		  <h4>{{theme.nom}}</h4>
		  <p>{{theme.description}}</p>

		  <div class="row col s3" v-for="quizz in theme.quizz">
			  <div class="card blue-grey darken-1">
				<div class="card-content white-text">
					<span class="card-title">{{quizz.nom}}</span>
					<span class="card-title" v-if="user.id == quizz.id_createur" v-for="user in users">Auteur : {{user.login}}</span>
				</div>
				<div class="card-action">
					<a href="#">Télécharger</a>
				</div>
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
			theme : '',
			selected:'',
			users: [],
			user: ''
		}
	},
	mounted() {
		window.axios.get('themes').then(response => { 
			this.themes = response.data.themes
		})
		window.axios.get('users').then(response => { 
			this.users = response.data.users
		})
	},
	methods: {
	}
}
</script>
<style scoped>
</style>
