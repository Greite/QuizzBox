<template>
	<div class="row">
		<form class="col s6 offset-s3" @submit="seConnecter">
			<div class="row">
				<div class="input-field col s12">
					<input id="login" v-model="login" type="text" class="validate">
					<label for="login">Login</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" v-model="password" type="password" class="validate">
					<label for="password">Mot de passe</label>
				</div>
			</div>
			<div class="row">
				<button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit">Connexion
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
			login: '',
			password: '',
		}
	},
	methods: {
		seConnecter(){
			window.axios.post('users/signin', {
				login: this.login,
				password: this.password,
			}).then((response) => {
				this.$store.commit('setMember', response.data);
				this.$store.commit('setToken', response.data.token);
				this.$router.push({path: '/accueil'});
			}).catch((error) => {
				console.log(error)
			})
		}
	}
}
</script>

<style scoped>

</style>