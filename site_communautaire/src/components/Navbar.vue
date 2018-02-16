<template>
	<nav>
		<div class="nav-wrapper">
			<a href="#!" class="brand-logo">Site communautaire - QuizzBox</a>
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a href="#/inscription">Inscription</a></li>
				<li><a href="#/connexion">Connexion</a></li>
				<li><a class="btn-floating btn waves-effect waves-light red tooltipped" data-position="bottom" data-delay="50" data-tooltip="Deconnexion"><i class="material-icons">close</i></a></li>
			</ul>
			<ul class="side-nav" id="mobile-demo">
				<li><a href="#/inscription">Inscription</a></li>
				<li><a href="#/connexion">Connexion</a></li>
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
})

</script>

<style scoped>

</style>