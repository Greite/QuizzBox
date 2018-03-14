<template>
	<div class="row">
		<form class="col s12" @submit="creerQuizz">
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
				<button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit">Créer le quizz
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
</template>

<script>

export default {
	name: 'QuizzCreation',
	data () {
		return {
			nom: '',
			themes : [],
			theme : '',
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
				id_theme: this.theme,
				id_createur: this.$store.state.member.id
			}, {headers:  {'Authorization': 'Bearer ' + this.$store.state.member.token }}).then(response => {
				this.$router.push({path: '/question-creation'})
			})
		}
	}
}


$(document).ready(function(){
	$('ul.tabs').tabs();
});
</script>

<style scoped>
</style>