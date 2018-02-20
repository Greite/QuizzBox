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
      <div class="row">
        <button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit" name="action">Ajouter la question
          <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'QuizzQuestion',
  props: ['question'],
  data () {
    return {
      intitule : '',
      reponses : []
    }
  },
  mounted () {
  },
  methods: {
    ajouterQuestion() {   
      this.question
    }
  }
}
</script>

<style scoped>
</style>