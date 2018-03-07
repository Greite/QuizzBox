<template>
	<div class="row">
		<ul class="collection with-header">
        <li class="collection-header"><h4>Thèmes</h4></li>
        <li class="collection-item" v-for="theme in themes">{{theme.nom}}
          <div v-for="quizz in theme.quizz">
            {{quizz.nom}}
          </div>
        </li>
      </ul>
	</div>
</template>

<script>

export default {
	name: 'QuizzListe',
	data () {
		return {
			quizz : '',
			themes: [],
			theme : ''
		}
	},
	mounted() {
		window.axios.get('themes').then(response => { 
			this.themes = response.data.themes
		})
	},
	methods: {
	}
}
</script>
<style scoped>
</style>
