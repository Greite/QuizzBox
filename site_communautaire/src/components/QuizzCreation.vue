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
			<div class="row" v-for="n in nbQuestion">
				<h1>Question n°{{n}}</h1>
				<quizzQuestion></quizzQuestion>
			</div>
			<div class="row">
				<center>
					<a class="btn-floating btn-large waves-effect waves-light red" @click="ajoutQuestion"><i class="material-icons">exposure_plus_1</i></a>
					<a class="btn-floating btn-large waves-effect waves-light red" @click="supprQuestion"><i class="material-icons">exposure_neg_1</i></a>
				</center>
			</div>
			<div class="row">
				<button class="btn-large waves-effect waves-light col s8 offset-s2" type="submit" name="action">Créer le quizz
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
			question : '',
			nbQuestion: 1
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
				theme: this.theme
			}).then(response => {
				
			})
		},
		ajoutQuestion(){
			this.nbQuestion++
		},
		supprQuestion(){
			if (this.nbQuestion!=1) {
				this.nbQuestion--
			}
		}
	}
}


$(document).ready(function(){
	$('ul.tabs').tabs();
});
</script>

<style scoped>
</style>