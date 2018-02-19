<template>
	<div class="row">
		<form class="col s6 offset-s3" @submit="inscription">
			<div class="row">
				<div class="input-field col s12">
					<input id="login" v-model="login" type="text" class="validate">
					<label for="login">Login</label>
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
					<input id="mail" v-model="mail" type="email" class="validate">
					<label for="mail">Mail</label>
				</div>
				<div class="input-field col s6">
					<input id="mail_verif" v-model="mail_verif" type="email" class="validate">
					<label for="mail_verif">Vérification mail</label>
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
			login: '',
			password: '',
			password_verif: '',
			mail: '',
			mail_verif: ''
		}
	},
	methods: {
		inscription() {
	      if (this.password_verif!==this.password) {
	        alert('Les mots de passe ne correspondent pas')
	      }
	      else if (this.mail_verif!==this.mail) {
	        alert('Les mails ne correspondent pas')
	      }
	      else {
	        window.axios.post('users', {
	          login: this.login,
	          password: this.password,
	          mail: this.mail
	        }).then(response => {
	          this.$router.push({path: '/connexion'})
	        }).catch((error) => {
	          alert(error.response.data.error.join("\n"))
	        })
	      }
    	}
	}
}
</script>

<style scoped>

</style>