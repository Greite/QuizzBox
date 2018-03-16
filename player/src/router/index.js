import Vue from 'vue'
import Router from 'vue-router'
import Question from '@/components/Question'
import Accueil from '@/components/Accueil'
import IListenToSockets from '@/components/IListenToSockets'
import Attente from '@/components/Attente'

Vue.use(Router)

export default new Router({
	routes: [
	{
		path: '/question',
		name: 'Question',
		component: Question
	},
	{
		path: '/',
		name: 'Accueil',
		component: Accueil
	},
	{
		path: '/listen',
		name: 'Listen',
		component: IListenToSockets
	},
	{
		path: '/attente',
		name: 'Attente',
		component: Attente
	}
	]
})
