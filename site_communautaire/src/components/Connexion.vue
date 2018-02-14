<template>
	<div class="row">
		<form class="col s6 offset-s3" @submit="seConnecter">
			<div class="row">
				<div class="input-field col s12">
					<input id="pseudo" v-model="pseudo" type="text" class="validate">
					<label for="pseudo">Pseudo</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" v-model="password" type="password" class="validate">
					<label for="password">Mot de passe</label>
				</div>
			</div>
			<div class="row">
				<button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit" name="action">Connexion
					<i class="material-icons right">done</i>
				</button>
			</div>
		</form>
	</div>
</template>

<script>

export default {
	name: 'Connexion',
	data () {
		return {
			pseudo: '',
			password: '',
		}
	},
	methods: {
		seConnecter(){
			console.log("Inscription")
		}
	}
}
</script>

<style scoped>

</style>