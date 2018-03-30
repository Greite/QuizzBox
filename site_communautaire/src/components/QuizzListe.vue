<template>
	<div class="row">

		<div class="row">
			<p>
				<input type="radio" id="checktheme" value="0" v-model="picked"/>
				<label for="checktheme">Rechercher par thème</label>
			</p>
			<p>
				<input type="radio" id="checkquizz" value="1" v-model="picked"/>
				<label for="checkquizz">Rechercher par quizz (par mot-clé)</label>
			</p>
		</div>

		<div class="row" v-if="picked == 0">
			<div class="row col s12 m6 l3">
				<label >Rechercher un thème</label>
				<select id="selected" v-model="selected" class="browser-default">
					<option v-for="theme in themes" v-bind:value="theme.id">{{theme.nom}}</option>
				</select>
			</div>
			<div class="row col s12" v-for="theme in themes" v-if="theme.id == selected">
			  <h4>{{theme.nom}}</h4>
			  <p>{{theme.description}}</p>

			  <div class="row col s12 m6 l3" v-for="quizz in theme.quizz">
				  <div class="card blue-grey darken-1">
						<div class="card-content white-text">
							<span class="card-title">{{quizz.nom}}</span>
							<span class="card-title" v-if="user.id == quizz.id_createur" v-for="user in users">Auteur : {{user.login}}</span>
						</div>
						<div class="card-action">
							<a href="#">Télécharger</a>
							<span v-for="moyenne in moyennes" v-if="moyenne.id == quizz.id">Note moyenne : {{moyenne.moyenne}}/5</span>
							<p><router-link :to="{ name: 'CommentairesAffichage', params : {id:quizz.id} }">Espace commentaires</router-link></p>
						</div>
				  </div>
			  </div>
			</div>
		</div>

		<div class="row" v-if="picked == 1">
			<div class="row col s12 m6 l3">
				<label >Rechercher un quizz</label>
				<div class="input-field col s12">
					<input id="quizz" v-model="inputquizz" type="text" class="validate">
					<label for="quizz">Quizz</label>
				</div>
			</div>

			<div class="row col s12" v-for="quizz in quizzs" v-if="inputquizz != ''">

				<div class="card blue-grey darken-1" v-if="quizz.nom.toLowerCase().lastIndexOf(inputquizz.toLowerCase()) != -1">
					<div class="card-content white-text">
						<span class="card-title">{{quizz.nom}}</span>
						<span class="card-title" v-if="user.id == quizz.id_createur" v-for="user in users">Auteur : {{user.login}}</span>
					</div>
					<div class="card-action">
						<a href="#">Télécharger</a>
						<span v-for="moyenne in moyennes" v-if="moyenne.id == quizz.id">Note moyenne : {{moyenne.moyenne}}/5</span>
						<p><router-link :to="{ name: 'CommentairesAffichage', params : {id:quizz.id} }">Espace commentaires</router-link></p>
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
			quizzs: [],
			themes: [],
			theme : '',
			selected:'',
			users: [],
			user: '',
			inputquizz:'',
			picked:'',
			moyennes: [],
			moyenne: ''
		}
	},
	mounted() {
		window.axios.get('themes').then(response => {
			this.themes = response.data.themes
		})
		window.axios.get('users').then(response => {
			this.users = response.data.users
		})
		window.axios.get('quizz').then(response => {
			var self = this
			this.quizzs = response.data.quizz
			response.data.quizz.forEach(function(element) {
				var moyenne = 0
				var id = element.id
				window.axios.get('quizz/'+element.id+'/notes').then(response => {
					var total = 0
					var i = 0
					response.data.notes.forEach(function(e) {
						total+=e.valeur
						i++
					})
				  moyenne = total/i
					console.log(id)
					self.moyennes.push({id, moyenne})
				})

			})
		})
	},
	methods: {
	}
}
</script>
<style scoped>
</style>
