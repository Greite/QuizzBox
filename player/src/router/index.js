import Vue from 'vue'
import Router from 'vue-router'
import Question from '@/components/Question'
import Accueil from '@/components/Accueil'
import VueSocketio from 'vue-socket.io';

Vue.use(VueSocketio, 'http://localhost:8080');
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
	}
	]
})
