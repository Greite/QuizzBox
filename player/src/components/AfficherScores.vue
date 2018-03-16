<template>
	<div v-for="s in scores">
		<p>Scores : {{s.score}} pseudo : {{s.pseudo}}<p>
	</div>
</template>

<script>
export default {
	name: 'AfficherScores',
	data() {
		return {
			scores : []
		}
	},
	mounted(){
		window.axios.get('scores/'+window.bus.id).then(response=>{
			this.scores = response.data
		})
	}
	sockets: {
		
	},
	methods: {
	}
}
</script>