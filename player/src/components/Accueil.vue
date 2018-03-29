<template>
	<div class="row">
		<div class="col s12">
			<div class="card grey lighten-4">
				<div class="card-content black-text">
					<span class="card-title">Accueil</span>
					<p>Bienvenue sur le player QuizzBox</p>
					<a v-if="inputPseudo" href="#/admin">Admin</a>
				</div>
				<div class="card-action" v-if="inputPseudo">
					<p>Veuillez choisir un pseudo</p>
					<div class="row">
						<form @submit="valPseudo">
							<div class="row">
								<div class="input-field">
									<input id="pseudo" v-model="pseudo" type="text" class="validate">
									<label for="pseudo">Pseudo</label>
								</div>
							</div>
						</form>
					</div>
					<div v-if="verifP === false">Pseudo déjà sélectionné</div>
				</div>
				<div v-if='inputPseudo === false'>
					<div class="card-action">
						<p>{{pseudos.length}} joueurs présents dans la partie : </p>
						<div class="chip" v-for="p in pseudos">
							<img src="../assets/ic_account_circle_black_48dp_1x.png" alt="Player">
							{{p}}
						</div>
						<div class="card-action">
							<div class="row">
								<center>
									<p>En attente d'autres joueurs !</p>
								</center>
							</div>
							<div class="row">
								<div class="progress">
									<div class="indeterminate"></div>
								</div>
							</div>
						</div>
						<div v-if="pseudo === pseudos[0]">
							<center><h5>Tu es le maître du jeu !</h5>
								<p><b>Choisis un thème et commence.</b></p></center>
								<ul class="collection">
									<li class="collection-item" v-for="t in themes">
										<center><div class="title"><b>{{t.nom}}</b></div></center>
										<center><div class="btn" v-for="quizz in t.quizz" @click='selectQuizz(quizz.id,quizz.nom)'>{{quizz.nom}}</div></center>
									</li>
								</ul>
								<div><center>Quizz sélectionné : {{nomQuizz}}</center></div>

								<center v-if="nomQuizz !== '' && pseudos.length >= 1"><button class="btn" @click="commencerPartie">Commencer la partie</button></center>
							</div>
							<div v-else>
								<center><h5>Tu n'es pas le maître du jeu ! Attends sa décision !</h5></center>
								<div>Liste des quizz</div>
								<ul class="collection">
									<li class="collection-item" v-for="t in themes">
										<center><div class="title"><b>{{t.nom}}</b></div></center>
										<center><div class="btn" v-for="quizz in t.quizz">{{quizz.nom}}</div></center>
									</li>
								</ul>
								<div><center>Quizz sélectionné par le maître du jeu : {{nomQuizz}}</center></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</template>

	<script>

	export default {
		name: 'Accueil',
		data () {
			return {
				pseudos : [],
				themes : [],
				pseudo: '',
				idQuizz : '',
				nomQuizz : '',
				verifP : true,
				inputPseudo: true
			}
		},
		sockets: {
			savePseudo(data) {
				this.pseudos = data
			},
			demarrer(){
				if(!this.inputPseudo) {
					this.$router.push({path: '/question'})
				}
				else {
					this.$router.push({path: '/attente'})
				}
			},
			saveQuizz(data){
				this.nomQuizz = data
				window.bus.nomQuizz = data
			},
			readThemes(data){
				this.themes = JSON.parse(data)
			},
			partieOn(){
				this.$router.push({path: '/attente'})
			}
		},
		methods: {
			valPseudo(){
				if(this.pseudos.indexOf(this.pseudo) == -1 && this.pseudo !== ''){
					window.bus.pseudo = this.pseudo
					this.$socket.emit('nouveau_joueur', this.pseudo);
					this.inputPseudo = false
				}
				else{
					this.verifP = false
					console.log("nan pas possible")
				}
			},
			commencerPartie(){
				this.$socket.emit('commencer',this.idQuizz);
			},
			selectQuizz(id,nom){
				this.idQuizz = id
				window.bus.id = id
				this.$socket.emit('nomQuizz',nom)
			}
		}
	}
	</script>

	<style scoped>

	</style>
