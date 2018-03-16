 <template>
 	<div class="row">
 		<div class="col s12">
 			<div class="card grey lighten-4">
 				<div class="card-content black-text">
 					<span class="card-title">Question N°{{i+1}}</span><span class="right">{{score}}</span>
 					<p>{{questions.quizz[i].texte}}</p>
 				</div>
 				<div class="card-action">
 					<div v-if="preloader">
 						<div class="row">
 							<button class="waves-effect waves-light btn-large col s5" @click="reponse(questions.quizz[i].reponses[0].etat)">{{questions.quizz[i].reponses[0].texte}}</button>
 							<a class="waves-effect waves-light btn-large col s5 offset-s2" @click="reponse(questions.quizz[i].reponses[1].etat)">{{questions.quizz[i].reponses[1].texte}}</a>
 						</div>
 						<div class="row">
 							<a class="waves-effect waves-light btn-large col s5" @click="reponse(questions.quizz[i].reponses[2].etat)">{{questions.quizz[i].reponses[2].texte}}</a>
 							<a class="waves-effect waves-light btn-large col s5 offset-s2" @click="reponse(questions.quizz[i].reponses[3].etat)">{{questions.quizz[i].reponses[3].texte}}</a>
 						</div>
 					</div>
 					<div v-if="!preloader">
 						<div class="row">
 							<button class="waves-effect waves-light btn-large col s5" v-bind:class="{'red accent-4': !questions.quizz[i].reponses[0].etat, 'lime accent-4': questions.quizz[i].reponses[0].etat}">{{questions.quizz[i].reponses[0].texte}}</button>
 							<a class="waves-effect waves-light btn-large col s5 offset-s2" v-bind:class="{'red accent-4': !questions.quizz[i].reponses[1].etat, 'lime accent-4': questions.quizz[i].reponses[1].etat}">{{questions.quizz[i].reponses[1].texte}}</a>
 						</div>
 						<div class="row">
 							<a class="waves-effect waves-light btn-large col s5" v-bind:class="{'red accent-4': !questions.quizz[i].reponses[2].etat, 'lime accent-4': questions.quizz[i].reponses[2].etat}">{{questions.quizz[i].reponses[2].texte}}</a>
 							<a class="waves-effect waves-light btn-large col s5 offset-s2" v-bind:class="{'red accent-4': !questions.quizz[i].reponses[3].etat, 'lime accent-4': questions.quizz[i].reponses[3].etat}">{{questions.quizz[i].reponses[3].texte}}</a>
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
 						<center>
 							<h5 v-if="pseudos[0] === pseudo">{{reponses}} joueurs sur {{pseudos.length}} ont répondu</h5>
 							<h5 v-else >En attente du maitre du jeu !</h5>
 						</center>
 						<div class="progress">
 							<div class="indeterminate"></div>
 						</div>
 					</div>
 					<div class="row" v-if="!preloader && pseudos[0] === pseudo && pseudos.length === reponses">
 						<a class="waves-effect waves-light btn-large col s4 offset-s4" @click="socketSuivant">Suivant</a>
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
 			messageReponse : "",
 			score : 0,
 			reponses : 0,
 			questions : [],
 			pseudo : "",
 			pseudos : [],
 			inter: null,
 			preloader: true,
 			vert: true,
 			orange: false,
 			rouge: false
 		}
 	},
 	mounted(){
    this.$socket.emit('recupId')
   	this.inter = setInterval(this.timer, 1000)
    this.pseudo = window.bus.pseudo
 	},
 	sockets: {
 		saveId(data){
      if (data.pseudo === "") {
        this.$router.push({path: '/attente'})
      }
 			this.idQuizz = data.quizz_id
 			this.pseudos = data.pseudos
 			window.axios.get('questions/'+data.quizz_id+'/reponses').then(response => {
 				this.questions = response.data
 			})
 		},
 		questionSuivant(){
 			this.i++
 			this.inter = setInterval(this.timer, 1000)
 			this.preloader = true
 			this.temps = 20
 			this.vert = true
 			this.orange = false
 			this.red = false
 		},
 		nbReponses(data){
 			this.reponses = data
 			console.log(this.reponses)
 		},
 	},
 	methods: {
 		socketSuivant(){
 			this.$socket.emit('suivant')
 		},
 		timer(){
 			if (this.temps == 11) {
 				this.vert = false
 				this.orange = true
 			}else if(this.temps == 6){
 				this.orange = false
 				this.rouge = true
 			}
 			if (this.temps!=1) {
 				this.temps--
 			}else{
 				clearInterval(this.inter)
 				this.$socket.emit('nombreReponse')
 				this.preloader = false
 			}
 		},
 		reponse(state){
 			this.$socket.emit('nombreReponse')
 			clearInterval(this.inter)
 			this.preloader = false
 			if(state){
 				if(this.temps){
 					switch(this.temps) {
 						case 18:
 						this.score = this.score + 18
 						break;
 						case 17:
 						this.score = this.score + 17
 						break;
 						case 16:
 						this.score = this.score + 16
 						break;
 						case 15:
 						this.score = this.score + 15
 						break;
 						case 14:
 						this.score = this.score + 14
 						break;
 						case 13:
 						this.score = this.score + 13
 						break;
 						case 12:
 						this.score = this.score + 12
 						break;
 						case 11:
 						this.score = this.score + 11
 						break;
 						case 10:
 						this.score = this.score + 10
 						break;
 						case 9:
 						this.score = this.score + 9
 						break;
 						case 8:
 						this.score = this.score + 8
 						break;
 						case 7:
 						this.score = this.score + 7
 						break;
 						case 6:
 						this.score = this.score + 6
 						break;
 						case 5:
 						this.score = this.score + 5
 						break;
 						case 4:
 						this.score = this.score + 4
 						break;
 						case 3:
 						this.score = this.score + 3
 						break;
 						case 2:
 						this.score = this.score + 2
 						break;
 						case 1:
 						this.score = this.score + 1
 						break;
 						default:
 						this.score = this.score + 20
 					}
 				}
 			}else{
 				this.messageReponse = "C'est faux"
 			}
 		}
 	}
 }
 </script>

 <style scoped>

 </style>
