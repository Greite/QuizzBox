<template>
	<div class="row">
		<form class="col s6 offset-s3" @submit="creerQuizz">   
			<div class="row">
				<div class="input-field col s12">
					<input id="nom" v-model="nom" type="text" class="validate">
					<label for="nom">Nom</label>
				</div>
			</div>
			<div class="row">
				<label>Thème</label>
				<select id="theme" v-model="theme" class="browser-default col s12">
					<option v-for="theme in themes" v-bind:value="theme.id">{{theme.nom}}</option>
				</select>
			</div>
			<div class="row">
				<quizzQuestion v-for="n in range"></quizzQuestion>
			</div>
			<div class="row">
				<button class="btn-large waves-effect waves-light col s4 offset-s4" @click="ajouterQuestion">Ajouter une question
					<i class="material-icons right">send</i>
				</button>
			</div>
			<div class="row">
				<button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit">Créer le quizz
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
</template>

<script>

import QuizzQuestion from './QuizzQuestion.vue'

export default {
	name: 'QuizzCreation',
	components: {QuizzQuestion},
	data () {
		return {
			nom: '',
			themes : [],
			theme : '',
			questions : [],
			question : '',
			range:0
		}
	},
	mounted () {
		window.axios.get('themes').then(response => { 
			this.themes = response.data.themes  
		})
	},
	methods: {
		creerQuizz() {   
			window.axios.post('quizz', {
				nom: this.nom,
				theme: this.theme,
			}).then(response => {
				this.$router.push({path: '/accueil'});  
			})
		},
		ajouterQuestion() {
			this.range += 1
		}
	}
}
</script>

<style scoped>
</style>