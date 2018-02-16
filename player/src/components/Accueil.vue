<template>
	<div class="row">
		<div class="col s12">
			<div class="card grey lighten-4">
				<div class="card-content black-text">
					<span class="card-title">Accueil</span>
					<p>Bienvenue sur le player QuizzBox</p>
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
					<div class="chip">
						<img src="../assets/ic_account_circle_black_48dp_1x.png" alt="Player">
						{{this.pseudo}}
					</div>
					<div class="chip">
						<img src="../assets/ic_account_circle_black_48dp_1x.png" alt="Player">
						{{this.player2}}
					</div>
					<div class="chip">
						<img src="../assets/ic_account_circle_black_48dp_1x.png" alt="Player">
						{{this.player3}}
					</div>
					<div class="chip">
						<img src="../assets/ic_account_circle_black_48dp_1x.png" alt="Player">
						{{this.player4}}
					</div>
				</div>
				<div class="card-action">
					<div class="row">
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
			pseudo: 'Joueur 1',
			player2: 'Joueur 2',
			player3: 'Joueur 3',
			player4: 'Joueur 4',
			inputPseudo: true
		}
	},
	mounted(){
		
	},
	methods: {
		valPseudo(){
			this.inputPseudo = false
		}
	}
}
</script>

<style scoped>

</style>