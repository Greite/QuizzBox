<template>
	<div class="row">
		<div class="container">
							<center><span class="aggrandir hide-on-small-only ">{{$store.state.member.login}}</span></center>
			<div class="card">
				<div class="card-content valign center">
					<p>Adresse e-mail : {{$store.state.member.mail}}</p>
					<p>Vos créations</p>
					<div v-for="theme in themes">
							<div class="card-tabs">
								<ul class="tabs tabs-fixed-width">
									<div class="tab red-text text-darken-2">{{theme.nom}}</div>
								</ul>
							</div>
						<div class="card-content" v-for="quizz in theme.quizz" v-if='$store.state.member.id == quizz.id_createur'>
							<p class="tab blue-text text-darken-3">{{quizz.nom}}</p>
						</div>		
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