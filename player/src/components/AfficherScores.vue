<template>
	<div>
		<div class="row">
			<div class="col s12">
				<div class="card grey lighten-4">
					<div class="card-content black-text">
						<span class="card-title">Scores de la partie</span>
						<ul class="collection with-header">
							<li class="collection-header"><h6><b>{{nomQuizz}}</b></h6></li>
							<li class="collection-item" v-for="s in scoresPartie"><div>{{s[1]}}<a class="secondary-content">{{s[0]}}</a></div></li>
						</ul>
					</div>
				</div>
			<!--<div class="card grey lighten-4">
					<div class="card-content black-text">
						<span class="card-title">Meilleurs scores de ce quizz</span>
						<ul class="collection with-header">
							<li class="collection-header"><h6><b>{{nomQuizz}}</b></h6></li>
							<li class="collection-item" v-for="s in meilleurScores"><div>{{s.pseudo}}<a class="secondary-content">{{s.score}}</a></div></li>
						</ul>
					</div>
				</div>!-->
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: 'AfficherScores',
	data() {
		return {
			meilleurScores : [],
			scoresPartie : [],
			nomQuizz: false
		}
	},
	mounted(){
		this.$socket.emit('loadQuizzId')

	},
	sockets: {
		saveQuizzId(data){
			this.scoresPartie = data.tabScore;
			this.nomQuizz = data.quizz_nom
			/*window.axios.get('scores/'+data.quizz_id).then(response=>{
				this.meilleurScores = response.data.score
			})*/
 		}
	},
	methods: {
	}
}
</script>
