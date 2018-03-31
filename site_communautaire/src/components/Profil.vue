<template>
	<div class="row">
		<div class="container">
			<center><span class="aggrandir hide-on-small-only ">{{$store.state.member.login}}</span>
				<br>
				<span class="hide-on-small-only">Adresse e-mail : {{$store.state.member.mail}}</span>
			</center>
		</div>
		<div class="row col s12" v-for="theme in themes">
			<h4>{{theme.nom}}</h4>
			<p>{{theme.description}}</p>
			<div class="row col s12 m6 l3" v-for="quizz in theme.quizz" v-if='$store.state.member.id == quizz.id_createur'>

				<div class="card blue-grey darken-1">
					<div class="card-content white-text">
						<p>{{quizz.nom}}</p>
					</div>
					<div class="card-action">
					</div>
				</div>
			</div>
		</div>
	</div>

</template>

<script>

export default {
	name: 'Profil',
	data () {
		return {
			quizz : '',
			themes: [],
			theme : '',
			users: [],
			user: '',
		}
	},
	mounted() {
		window.axios.get('themes').then(response => {
			this.themes = response.data.themes
		})
		window.axios.get('users').then(response => {
			this.users = response.data.users
		})
	},
	methods: {
	}
}
</script>
<style scoped>

.aggrandir{
	font-size: 3vw;
	text-align: center;

}


</style>
