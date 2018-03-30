<template>
	<div class="row">
		<div v-bind:class="classalert" v-if="message != ''">{{message}}</div>
		<form class="col s12 m6 l3 offset-l4" @submit="creerQuizz">
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
				<button class="btn-large waves-effect waves-light col offset-s3 offset-m4 offset-l4" type="submit">Créer le quizz
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
			message: '',
			classalert:''
		}
	},
	mounted () {
		window.axios.get('themes').then(response => {
			this.themes = response.data.themes
		})
	},
	methods: {
		creerQuizz() {
			let message = ''
			if (this.theme == '') {
				message+="Veuillez choisir un thème. "
			}
			if (this.nom == '') {
				message+="Veuillez remplir le nom. "
			}
			if (message != '') {
				this.message = message
				this.classalert="card-panel red lighten-2"
			}
			else {
				window.axios.post('quizz', {
					nom: this.nom,
					id_theme: this.theme,
					id_createur: this.$store.state.member.id
				}, {headers:  {'Authorization': 'Bearer ' + this.$store.state.member.token }}).then(response => {
					this.$router.push({path: '/quizz-creation'})
					this.nom=''
					this.message='Le quizz a bien été créé'
					this.classalert="card-panel green lighten-2"
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
