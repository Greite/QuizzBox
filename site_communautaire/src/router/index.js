import Vue from 'vue'
import Router from 'vue-router'
import Connexion from '@/components/Connexion'
import Inscription from '@/components/Inscription'
import QuizzCreation from '@/components/QuizzCreation'
import QuizzListe from '@/components/QuizzListe'

Vue.use(Router)

export default new Router({
	routes: [
	{
		path: '/connexion',
		name: 'Connexion',
		component: Connexion
	},
	{
		path: '/inscription',
		name: 'Inscription',
		component: Inscription
	},
	{
		path: '/quizz-creation',
		name: 'QuizzCreation',
		component: QuizzCreation
	},
	{
		path: '/quizz-liste',
		name: 'QuizzListe',
		component: QuizzListe
	}
	]
})
