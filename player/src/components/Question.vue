<template>
	<div class="row">
		<div class="col s12">
			<div class="card grey lighten-4">
				<div class="card-content black-text">
					<span class="card-title">Question N°x</span>
					<p>Bonjour je suis le corps de la question voici les 4 réponse donc une seule est vrai</p>
				</div>
				<div class="card-action">
					<div class="row">
						<a class="waves-effect waves-light btn-large col s5" @click="reponse1">Réponse N°1</a>
						<a class="waves-effect waves-light btn-large col s5 offset-s2" @click="reponse2">Réponse N°2</a>
					</div>
					<div class="row">
						<a class="waves-effect waves-light btn-large col s5" @click="reponse3">Réponse N°3</a>
						<a class="waves-effect waves-light btn-large col s5 offset-s2" @click="reponse4">Réponse N°4</a>
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
							<h3>En attente du maitre du jeu !</h3>
						</center>
					</div>
					<div class="row" v-if="!preloader">
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
			inter: null,
			preloader: true,
			vert: true,
			orange: false,
			rouge: false
		}
	},
	mounted(){
		this.inter = setInterval(this.timer, 1000)
	},
	methods: {
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