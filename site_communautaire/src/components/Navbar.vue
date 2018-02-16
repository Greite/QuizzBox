<template>
	<nav>
		<div class="nav-wrapper">
			<a href="#!" class="brand-logo">Site communautaire - QuizzBox</a>
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a href="#/inscription">Inscription</a></li>
				<li><a href="#/connexion">Connexion</a></li>
			</ul>
			<ul class="side-nav" id="mobile-demo">
				<li><a href="#/inscription">Inscription</a></li>
				<li><a href="#/connexion">Connexion</a></li>
				<li @click="logOut">Déconnexion</li>
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
})

</script>

<style scoped>

</style>