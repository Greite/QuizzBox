<template>
	<div class="row">
		<div class="card-panel red lighten-2" v-if="messageno != ''">{{messageno}}</div>
		<div class="card-panel green lighten-2" v-if="messageok != ''">{{messageok}}</div>
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
			messageno: '',
			messageok: ''
		}
	},
	mounted () {
		window.axios.get('themes').then(response => { 
			this.themes = response.data.themes  
		})
	},
	methods: {
		creerQuizz() {  
			this.messageok=''
			let message = ''
			if (this.theme == '') {
				message+="Veuillez choisir un thème. "
			}
			if (this.nom == '') {
				message+="Veuillez remplir le nom. "
			}
			this.messageno = message

			if (message == '') {
				window.axios.post('quizz', {
					nom: this.nom,
					id_theme: this.theme,
					id_createur: this.$store.state.member.id
				}, {headers:  {'Authorization': 'Bearer ' + this.$store.state.member.token }}).then(response => {
					this.$router.push({path: '/quizz-creation'})
					this.nom=''
					this.messageok='Le quizz a bien été créé'
				})
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