// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import socketio from 'socket.io-client';
import VueSocketIO from 'vue-socket.io';
import axios from 'axios'
import VModal from 'vue-js-modal'

Vue.use(VModal)


window.axios = axios.create({
	baseURL: 'http://api.quizzbox.local:10080'
});

Vue.config.productionTip = false

Vue.use(VueSocketIO, socketio('http://localhost:3000'))

window.bus = new Vue();
/* eslint-disable no-new */
new Vue({
	el: '#app',
	router,
	components: { App },
	template: '<App/>'
})
