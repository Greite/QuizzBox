<template>
	<div>
		<div class="row">
			<div class="col s12">
				<div class="card grey lighten-4">
					<div class="card-content black-text">
						<span class="card-title">Scores</span>
						<ul class="collection with-header">
							<li class="collection-header"><h6><b>{{nomQuizz}}</b></h6></li>
							<li class="collection-item" v-for="s in scores"><div>{{s.pseudo}}<a class="secondary-content">{{s.score}}</a></div></li>
						</ul>
					</div>
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
			scores : [],
			nomQuizz: false
		}
	},
	mounted(){
		this.nomQuizz = window.bus.nomQuizz;
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
