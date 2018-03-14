<template>
	<div class="row">
		<form class="col s6 offset-s3" @submit="creerQuestion">
			<div class="row">
				<label>Quizz</label>
				<select id="quizz" v-model="quizz" class="browser-default col s12">
					<option v-for="quizz in quizzs" v-bind:value="quizz.id">{{quizz.nom}}</option>
				</select>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="intitule" v-model="intitule" type="text" class="validate">
					<label for="intitule">Intitulé</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="reponse1" v-model="reponse1" type="text" class="validate">
					<label for="reponse1">Réponse 1</label>
				</div>
				<div class="input-field col s6">
					<input id="reponse2" v-model="reponse2" type="text" class="validate">
					<label for="reponse2">Réponse 2</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="reponse3" v-model="reponse3" type="text" class="validate">
					<label for="reponse3">Réponse 3</label>
				</div>
				<div class="input-field col s6">
					<input id="reponse4" v-model="reponse4" type="text" class="validate">
					<label for="reponse4">Réponse 4</label>
				</div>
			</div>
			<div class="row">
				<button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit">Créer la question
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
</template>

<script>
export default {
	name: 'QuestionCreation',
	data () {
		return {
			intitule: '',
			reponse1: '',
			reponse2: '',
			reponse3: '',
			reponse4: '',
			etat1: '',
			etat2: '',
			etat3: '',
			etat4: '',
			quizzs: []
		}
	},
	mounted () {
		window.axios.get('quizz').then(response => { 
			this.quizzs = response.data.quizz
		})
	},
	methods: {
		creerQuestion(){
			window.axios.post('questions', {
				intitule: this.intitule,
				id_quizz: this.quizz,
			}).then(response => {
				window.axios.post('reponses', {
				reponses: [this.reponse1, this.reponse2, this.reponse3, this.reponse4]
				}).then(response => {
					this.$router.push({path: '/accueil'});  
				})
			})
		}
	}
}
</script>

<style scoped>
</style>