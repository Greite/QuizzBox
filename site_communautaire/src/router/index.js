import Vue from 'vue'
import Router from 'vue-router'
import Connexion from '@/components/Connexion'
import Inscription from '@/components/Inscription'

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
	}
	]
})
