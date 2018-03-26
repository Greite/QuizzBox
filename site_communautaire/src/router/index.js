import Vue from 'vue'
import Router from 'vue-router'
import Connexion from '@/components/Connexion'
import Inscription from '@/components/Inscription'
import QuizzCreation from '@/components/QuizzCreation'
import QuizzListe from '@/components/QuizzListe'
import QuestionCreation from '@/components/QuestionCreation'
import Profil from '@/components/Profil'
import CommentairesAffichage from '@/components/CommentairesAffichage'

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
	},
	{
		path: '/question-creation',
		name: 'QuestionCreation',
		component: QuestionCreation
	},
	{
		path: '/profil',
		name: 'Profil',
		component: Profil
	},
	{
		path: '/commentaires-affichage',
		name: 'CommentairesAffichage',
		component: CommentairesAffichage
	}
	]
})
