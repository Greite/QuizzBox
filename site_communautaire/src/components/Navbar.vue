<template>
	<nav v-if="!this.$store.state.member">
		<div class="nav-wrapper grey darken-3">
			<a href="#/accueil" class="brand-logo">Site communautaire - QuizzBox</a>
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a href="#/inscription">Inscription</a></li>
				<li><a href="#/connexion">Connexion</a></li>
			</ul>
			<ul class="side-nav" id="mobile-demo">
				<li><a href="#/inscription">Inscription</a></li>
				<li><a href="#/connexion">Connexion</a></li>
			</ul>
		</div>
	</nav>
	<nav v-else>
		<div class="nav-wrapper grey darken-3">
			<a href="#/accueil" class="brand-logo">Site communautaire - QuizzBox</a>
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a href="#/quizz-creation">Créer un quizz</a></li>
				<li><a href="#/question-creation">Créer une question</a></li>
				<li><a href="#/quizz-liste">Liste des quizz</a></li>
				<li><a href="#/profil">Profil</a></li>
				<li><a @click="logOut" class="btn-floating btn-large waves-effect waves-light red tooltipped" data-position="bottom" data-delay="50" data-tooltip="Deconnexion"><i class="material-icons">close</i></a></li>
			</ul>
			<ul class="side-nav" id="mobile-demo">
				<li><a href="#/quizz-creation">Créer un quizz</a></li>
				<li><a href="#/question-creation">Créer une question</a></li>
				<li><a href="#/quizz-liste">Liste des quizz</a></li>
				<li><a href="#/profil">Profil</a></li>
				<li><a href="#/" class="red">Deconnexion</a></li>
			</ul>
		</div>
	</nav>
</template>

<script>   

export default {
	name: 'Navbar',
	data () {
		return {
		}
	},
	methods: {
		logOut(){
			window.bus.$emit("logout");
		}
	}
}

$( document ).ready(function(){
	$(".button-collapse").sideNav();
	$('.tooltipped').tooltip({delay: 50});
});

</script>

<style scoped>

</style>