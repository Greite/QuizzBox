<template>
	<div id="app">
		<navbar></navbar>
		<router-view/>
	</div>
</template>

<script>

import Navbar from '@/components/Navbar'

export default {
	name: 'app',
	components: {Navbar},
	mounted(){
		if (!this.$store.state.member) {
			this.$router.push({path: '/connexion'});
		} else{
			this.$router.push({path: '/accueil'});
		}
		window.bus.$on('logout', () => {
			this.$store.commit('setMember', false);
			this.$store.commit('setToken', false);
			this.$router.push({path: '/connexion'});
		})
	}
}
</script>

<style>

</style>
