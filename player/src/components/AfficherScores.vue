<template>
	<div>
		<div class="row">
			<div class="col s12">
				<div class="card grey lighten-4">
					<div class="card-content black-text">
						<p>Affichage des scores</p>
					</div>
					<p class="card-action" v-for="s in scores">Scores : {{s.score}} pseudo : {{s.pseudo}}</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: 'AfficherScores',
	data() {
		return {
			scores : []
		}
	},
	mounted(){
		window.axios.get('scores/'+window.bus.id).then(response=>{
			this.scores = response.data.score
		})
	},
	sockets: {
		
	},
	methods: {
	}
}
</script>