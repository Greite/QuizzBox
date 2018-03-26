<template>
  <div>
     <h1>{{quizz.nom}}</h1>
     <hr>
     <ul>
      <commentaireElement v-for="commentaire of commentaires" :key="commentaire.id" :commentaire="commentaire"></commentaireElement>
     </ul>
    <hr>
     <form @submit="creerCommentaire">
     <div>
       <div class="row">
 				<div class="input-field col s12">
 					<input id="commentaire" v-model="inputmessage" type="text" class="validate">
 					<label for="commentaire">Commentaire</label>
 				</div>
 			</div>
      <div class="row">
        <button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit">Créer !
          <i class="material-icons right">send</i>
        </button>
      </div>
     </div>
   </form>
  </div>
</template>

<script>

import CommentaireElement from './CommentaireElement.vue'

export default {
  name: 'CommentairesAffichage',
  components: {CommentaireElement},
  data () {
    return {
      quizz : [],
      commentaires : [],
      commentaire : '',
      inputmessage: '',
      timer: ''
    }
  },
  mounted() {
    window.axios.get('quizz/'+this.$route.params.id)
    .then(response => {
      this.quizz = response.data.quizz
    })
    .catch(e => {
      this.errors.push(e)
    }),
    this.rafraichirMessages()
    this.timer = setInterval(this.rafraichirMessages, 5000)
    window.bus.$on('rechargerMessage', this.rafraichirMessages)
  },
  methods: {
      creerCommentaire() {
      window.axios.post('quizz/'+this.$route.params.id+'/commentaires', {
        message: this.inputmessage,
        id_quizz: this.quizz.id,
        id_auteur: this.$store.state.member.id
      }, {headers:  {'Authorization': 'Bearer ' + this.$store.state.member.token }}).then(response => {
        this.commentaire = ''
        this.rafraichirMessages()
      })
    },
      rafraichirMessages() {
        window.axios.get('quizz/'+this.$route.params.id+'/commentaires')
         .then(response => {
         this.commentaires = response.data.commentaires
       }).catch(e => {
         this.errors.push(e)
    })
    }
  },
  beforeDestroy() {
    clearInterval(this.timer)
  }
}
</script>
<style scoped>

h1,h2{

text-align: center;

}

.chat{
width: 90%

}
</style>
