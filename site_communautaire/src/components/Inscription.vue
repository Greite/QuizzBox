<template>
	<div class="row">
		<form class="col s6 offset-s3" @submit="inscription">
			<div class="row">
				<div class="input-field col s12">
					<input id="pseudo" v-model="pseudo" type="text" class="validate">
					<label for="pseudo">Pseudo</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="password" v-model="password" type="password" class="validate">
					<label for="password">Mot de passe</label>
				</div>
				<div class="input-field col s6">
					<input id="password_verif" v-model="password_verif" type="password" class="validate">
					<label for="password_verif">Vérification mot de passe</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="email" v-model="email" type="email" class="validate">
					<label for="email">Email</label>
				</div>
				<div class="input-field col s6">
					<input id="email_verif" v-model="email_verif" type="email" class="validate">
					<label for="email_verif">Vérification Email</label>
				</div>
			</div>
			<div class="row">
				<button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit" name="action">Inscription
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
</template>

<script>

export default {
	name: 'Inscription',
	data () {
		return {
			pseudo: '',
			password: '',
			password_verif: '',
			email: '',
			email_verif: ''
		}
	},
	methods: {
		inscription(){
			console.log("Inscription")
		}
	}
}
</script>

<style scoped>

</style>