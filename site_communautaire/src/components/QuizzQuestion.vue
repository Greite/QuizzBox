<template>
	<div class="row">
		<div class="row">
			<div class="input-field col s12">
				<input id="intitule" v-model="intitule" type="text" class="validate">
				<label for="intitule">Intitulé</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input id="reponse1" v-model="reponse1" type="text" class="validate">
				<label for="reponse1">Réponse 1</label>
			</div>
			<div class="input-field col s6">
				<input id="reponse2" v-model="reponse2" type="text" class="validate">
				<label for="reponse2">Réponse 2</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input id="reponse3" v-model="reponse3" type="text" class="validate">
				<label for="reponse3">Réponse 3</label>
			</div>
			<div class="input-field col s6">
				<input id="reponse4" v-model="reponse4" type="text" class="validate">
				<label for="reponse4">Réponse 4</label>
			</div>
		</div>
	</div>
</template>

<script>
export default {

  name: 'QuizzQuestion',
  data () {
	return {
	  intitule : '',
	  reponses : [],
	}
  },
  mounted () {
  },
  methods: {
  }

}
</script>

<style scoped>
</style>