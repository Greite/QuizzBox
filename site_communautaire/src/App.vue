<template>
	<div id="app">
		<navbar></navbar>
		<router-view/>
		<footer></footer>
	</div>
</template>

<script>

import Navbar from '@/components/Navbar'
import Footer from '@/components/Footer'

export default {
	name: 'app',
	components: {Navbar, Footer},
	mounted(){
		if (!this.$store.state.member) {
			this.$router.push({path: '/connexion'});
		} else{
			this.$router.push({path: '/profil'});
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
