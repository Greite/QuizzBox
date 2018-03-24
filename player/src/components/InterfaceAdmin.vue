<template>
	<div class="row">
		<div class="col s12">
			<div class="card grey lighten-4">
				<div class="card-content black-text">
					<span class="card-title">Interface de l'administrateur</br>Choisissez les quizz</span>
          <ul class="collection">
            <li class="collection-item" v-for="t in themes">
              <center><div class="title"><b>{{t.nom}}</b></div></center>
              <center><div class="btn" v-for="quizz in t.quizz" @click="selectQuizz(quizz.id,quizz.nom)">{{quizz.nom}}</div></center>
            </li>
          </ul>
					<h4>Quizz séléctionnés : </h4>
          <div v-for='n in nomQuizz'>
							<ul>
								<li>{{n.nom}}</li>
							</ul>
					</div>
          <button class="btn" @click="envoyerQuizz">Envoyer</button>
				</div>
      </div>
    </div>
	</div>
</template>

	<script>

	export default {
		name: 'InterfaceAdmin',
		data () {
			return {
        themes : [],
        quizz : [],
        nomQuizz : []
			}
		},
    mounted(){
      window.axios.get('themes').then(response => {
        this.themes = response.data.themes
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
				this.$socket.emit('createFileThemes',this.themes)
				})
  		},
      selectQuizz(id,nom){
        this.nomQuizz.push({nom,id})
      }
    }
	}
	</script>

	<style scoped>

	</style>
