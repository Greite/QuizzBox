<template>
  <div class="row">
	<form class="col s6 offset-s3" @submit="ajouterQuestion">   
	  <div class="row">
		<div class="input-field col s12">
		  <input id="intitule" v-model="intitule" type="text" class="validate">
		  <label for="intitule">Intitulé</label>
		</div>
	  </div>
	  <div class="row">
	  <div class="input-field col s3">
		<input id="reponse1" v-model="reponses" type="text" class="validate">
		<label for="reponse1">Réponse 1</label>
	  </div>
	  <div class="input-field col s3">
		<input id="reponse2" v-model="reponses" type="text" class="validate">
		<label for="reponse2">Réponse 2</label>
	  </div>
	  <div class="input-field col s3">
		<input id="reponse3" v-model="reponses" type="text" class="validate">
		<label for="reponse3">Réponse 3</label>
	  </div>
	  <div class="input-field col s3">
		<input id="reponse4" v-model="reponses" type="text" class="validate">
		<label for="reponse4">Réponse 4</label>
	  </div>
	  </div>
	</form>
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