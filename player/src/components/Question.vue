 <template>
	<div class="row">
		<div class="col s12">
			<div class="card grey lighten-4">
				<div class="card-content black-text">
					<span class="card-title">Question N°{{i+1}}</span>
					<p>{{questions.quizz[i].texte}}</p>
				</div>
				<div class="card-action">
					<div>
						<div class="row">
							<a class="waves-effect waves-light btn-large col s5" @click="reponse1">{{questions.quizz[i].reponses[0].texte}}</a>
							<a class="waves-effect waves-light btn-large col s5 offset-s2" @click="reponse2">{{questions.quizz[i].reponses[1].texte}}</a>
						</div>
						<div class="row">
							<a class="waves-effect waves-light btn-large col s5" @click="reponse3">{{questions.quizz[i].reponses[2].texte}}</a>
							<a class="waves-effect waves-light btn-large col s5 offset-s2" @click="reponse4">{{questions.quizz[i].reponses[3].texte}}</a>
						</div>
					</div>
					<div class="row" v-if="preloader">
						<center>
							<div class="preloader-wrapper big active offset-s6">
								<div class="spinner-layer" v-bind:class="{'spinner-green-only': vert, 'spinner-yellow-only': orange, 'spinner-red-only': rouge}">
									<div class="circle-clipper left">
										<div class="circle"></div>
									</div>
									<div class="gap-patch">
										<div class="circle"></div>
									</div>
									<div class="circle-clipper right">
										<div class="circle"></div>
									</div>
								</div>
							</div>
						</center>
					</div>
					<div class="row" v-if="preloader">
						<center>
							<h1>{{this.temps}}</h1>
						</center>
					</div>
					<div class="row" v-if="!preloader">
						<div>
							<center>
								<button @click="suivant">Suivant</button>
							</center>
						</div>
						<div>
							<center>
								<h3>En attente du maitre du jeu !</h3>
							</center>
						</div>
							<div class="progress">
								<div class="indeterminate"></div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>   

export default {
	name: 'Question',
	data () {
		return {
			temps: 20,
			i : 0,
			idQuizz : "",
			questions : [],
			inter: null,
			preloader: true,
			vert: true,
			orange: false,
			rouge: false
		}
	},
	mounted(){
		this.$socket.emit('recupId');
		this.inter = setInterval(this.timer, 1000)
	},
	sockets: {
		saveId(data){
			this.idQuizz = data
			window.axios.get('questions/'+data+'/reponses').then(response => { 
				this.questions = response.data
				console.log(this.questions.quizz[0].texte)
			})
		}
	},
	methods: {
		suivant(){
			this.i++
		},
		timer(){
			if (this.temps == 10) {
				this.vert = false
				this.orange = true
			}else if(this.temps == 5){
				this.orange = false
				this.rouge = true
			}
			if (this.temps!=0) {
				this.temps--
			}else{
				clearInterval(this.inter)
				this.preloader = false
			}
		},
		reponse1(){
			if(this.temps == 0){
				console.log('Trop tard !')
			}else {
				console.log('Réponse 1')
				this.temps = 0
			}
		},
		reponse2(){
			if(this.temps == 0){
				console.log('Trop tard !')
			}else {
				console.log('Réponse 2')
				this.temps = 0
			}
		},
		reponse3(){
			if(this.temps == 0){
				console.log('Trop tard !')
			}else {
				console.log('Réponse 3')
				this.temps = 0
			}
		},
		reponse4(){
			if(this.temps == 0){
				console.log('Trop tard !')
			}else {
				console.log('Réponse 4')
				this.temps = 0
			}
		}
	}
}
</script>

<style scoped>

</style>