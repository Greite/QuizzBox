<template>
	<div class="row">
		<form class="col s6 offset-s3" id="quizzform">
			<div class="row">
				<div class="input-field col s12">
					<input id="nom" v-model="nom" type="text" class="validate">
					<label for="nom">Nom</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="question" v-model="question" type="text" class="validate">
					<label for="question">Question</label>
				</div>
			</div>
			<div class="row">
				<button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit" name="action">Créer le quizz
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
</template>

<script>
export default {
	name: 'ConversationCreation',
	data(){
		return {
			nom: '',
			themes : [],
			theme : '',
			questions : [],
			question : ''
		}
	},
	mounted(){
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
		}
	}
}
</script>

<style scoped>
</style>