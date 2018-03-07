<template>
	<div class="row">
		<div class="col s12">
			<div class="card grey lighten-4">
				<div class="card-content black-text">
					<span class="card-title">Accueil</span>
					<p>Bienvenue sur le player QuizzBox</p>
					<p v-if="isConnected">We're connected to the server!</p>
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
				</div>
				<div class="card-action">
					<p>Joueurs présents dans la partie</p>
					<div class="chip" v-for="p in pseudos">
						<img src="../assets/ic_account_circle_black_48dp_1x.png" alt="Player">
						{{p}}
					</div>
				
				</div>
				<div class="card-action">
					<div class="row">
						<button @click="commencerPartie">Commencer la partie</button>
						<center>
							<h3>En attente d'autres joueurs !</h3>
						</center>
					</div>
					<div class="row">
						<div class="progress">
							<div class="indeterminate"></div>
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
			pseudo: '',
			pseudos : [],
			socketMessage: '',
			isConnected: false,
			inputPseudo: true
		}
	},
	mounted(){
		
	},
	sockets: {
		connect() {
			this.isConnected = true;
		},
		disconnect() {
			this.isConnected = false;
		},
		savePseudo(data) {
			this.pseudos = data
		},
		demarrer(){
			this.$router.push({path: '/question'});
		}

	},
	methods: {
		valPseudo(){
			this.$socket.emit('nouveau_joueur', this.pseudo);
			this.inputPseudo = false
		},
		commencerPartie(){
			this.$socket.emit('commencer')
		}
	}
}
</script>

<style scoped>

</style>