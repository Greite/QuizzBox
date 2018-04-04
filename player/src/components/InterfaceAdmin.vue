<template>
	<div class="row">
		<div class="col s12">
			<div class="card grey lighten-4">
				<div class="card-content black-text">
					<span class="card-title">Interface admin</span>
					<p>Choisissez les quizz que vous souhaitez télécharger !</p>
				</div>
			</div>
			<p>
				<input type="radio" id="checktheme" value="0" v-model="picked"/>
				<label for="checktheme">Rechercher par thème</label>
			</p>
			<p>
				<input type="radio" id="checkquizz" value="1" v-model="picked"/>
				<label for="checkquizz">Rechercher par quizz (par mot-clé)</label>
			</p>

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
			  <transition-group name="fade">
			  <div class="row col s12 m6 l3" v-for="quizz in theme.quizz"  :key="quizz.id">
				  <div class="collection">
						<div class="collection-item">
							<span class="btn" @click="selectQuizz(quizz.id,quizz.nom)"><b>{{quizz.nom}}</b></span>
							<span class="title" v-if="user.id == quizz.id_createur" v-for="user in users">Auteur : {{user.login}}</span>
							<span v-for="moyenne in moyennes" v-if="moyenne.id == quizz.id">Note moyenne : {{moyenne.moyenne}}/5</span>
						</div>
				  </div>
			  </div>
			  </transition-group>
			</div>
		</div>

		<div class="row" v-if="picked == 1">
			<div class="row col s12 m6 l3">
				<label>Rechercher un quizz</label>
				<div class="input-field col s12">
					<input id="quizz" v-model="inputquizz" type="text" class="validate">
					<label for="quizz">Quizz</label>
				</div>
			</div>

			<transition-group name="fade">
			<div class="row col s12" v-for="quizz in quizzs" :key="quizz.id" v-if="inputquizz != ''">
				<ul class="collection" v-if="quizz.nom.toLowerCase().lastIndexOf(inputquizz.toLowerCase()) != -1">
					<li class="collection-item">
						<center><div class="btn" @click='selectQuizz(quizz.id,quizz.nom)'>{{quizz.nom}}</div></center>
						<center><span v-if="user.id == quizz.id_createur" v-for="user in users">Auteur : {{user.login}}</span></center>
						<center><span v-for="moyenne in moyennes" v-if="moyenne.id == quizz.id">Note moyenne : {{moyenne.moyenne}}/5</span></center>
						
					</li>
				</ul>
			</div>
			</transition-group>
		</div>
		<div v-if="!selected">
			<ul class="collection" v-if="!inputquizz">
				<li class="collection-item" v-for="t in themes">
					<center><div class="title"><b>{{t.nom}}</b></div></center>
					<center><div class="btn" v-for="quizz in t.quizz" @click='selectQuizz(quizz.id,quizz.nom)'>{{quizz.nom}}</div></center>
					<span v-for="moyenne in moyennes" v-if="moyenne.id == quizz.id">Note moyenne : {{moyenne.moyenne}}/5</span>
				</li>
			</ul>
		</div>
		<ul v-if="nomQuizz.length !== 0 ">
    		<li v-for="q in nomQuizz">{{q.nom}}</li>
    		<p @click="envoyerQuizz" class="btn">Envoyer</p>
		</ul>
	</div>
</div>
</template>

<script>

export default {
	name: 'InterfaceAdmin',
	data () {
		return {
			quizz : '',
			nomQuizz : [],
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
	mounted(){
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
					self.moyennes.push({id, moyenne})
				})

			})
		})
	},
	sockets: {

	},
	methods: {
		envoyerQuizz(){
			var self = this;
			this.nomQuizz.forEach(function(e){
				window.axios.get('questions/'+e.id+'/reponses').then(response => {
					self.$socket.emit('createFileQuizz',[response.data,e.nom])
				})
			})
			this.$socket.emit('createFileThemes',this.themes)
		},
		selectQuizz(id,nom){
			this.nomQuizz.push({nom,id})
		}
	}
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
