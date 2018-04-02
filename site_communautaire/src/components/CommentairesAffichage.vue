<template>
  <div class="row">
    <div v-bind:class="classalert" v-if="alertmess != ''">{{alertmess}}</div>
     <h1>{{quizz.nom}}</h1>
     <div class="row col s12 m2 rating">
       <a href="#" title="Donner 5 étoiles" @click="note5etoiles">☆</a>
       <a href="#" title="Donner 4 étoiles" @click="note4etoiles">☆</a>
       <a href="#" title="Donner 3 étoiles" @click="note3etoiles">☆</a>
       <a href="#" title="Donner 2 étoiles" @click="note2etoiles">☆</a>
       <a href="#" title="Donner 1 étoile" @click="note1etoile">☆</a>
      </div>
      <div class="row col s12 m2 offset-s1">
        <p v-if="note != ''">Vous avez donné la note de {{note}}/5</p>
      </div>
     <ul class="collection col s12">
      <commentaireElement v-for="commentaire of commentaires" :key="commentaire.id" :commentaire="commentaire"></commentaireElement>
     </ul>
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
      timer: '',
      classalert:'',
      alertmess: '',
      note: '',
      note_id: '',
      newnote:''
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
    this.getNotes()
  },
  methods: {
      creerCommentaire() {
        if (this.inputmessage!= '') {
          window.axios.post('quizz/'+this.$route.params.id+'/commentaires', {
            message: this.inputmessage,
            id_quizz: this.quizz.id,
            id_auteur: this.$store.state.member.id
          }, {headers:  {'Authorization': 'Bearer ' + this.$store.state.member.token }}).then(response => {
            this.alertmess = 'Le commentaire a été ajouté !'
            this.classalert= 'card-panel green lighten-2'
            this.inputmessage = ''
            this.rafraichirMessages()
          })
        }
        else {
          this.alertmess = 'Veuillez remplir le champ !'
          this.classalert= 'card-panel red lighten-2'
        }
      },
      rafraichirMessages() {
        window.axios.get('quizz/'+this.$route.params.id+'/commentaires')
         .then(response => {
         this.commentaires = response.data.commentaires

       }).catch(e => {
         this.errors.push(e)
       })
     },
     sendNote() {
       this.getNotes()
       if (this.note == '') {
         window.axios.post('quizz/'+this.$route.params.id+'/notes', {
           valeur: this.newnote,
           id_quizz: this.quizz.id,
           id_user: this.$store.state.member.id
         }, {headers:  {'Authorization': 'Bearer ' + this.$store.state.member.token }}).then(response => {
           this.note = this.newnote
           this.alertmess = 'La note a été ajoutée !'
           this.classalert= 'card-panel green lighten-2'
         })
       }
       else {
         window.axios.put('quizz/'+this.$route.params.id+'/notes/'+this.note_id, {
           valeur: this.newnote,
           id_quizz: this.quizz.id,
           id_user: this.$store.state.member.id
         }, {headers:  {'Authorization': 'Bearer ' + this.$store.state.member.token }}).then(response => {
           this.note = this.newnote
           this.alertmess = 'La note a été modifiée !'
           this.classalert= 'card-panel green lighten-2'
         })
       }
     },
     note5etoiles() {
       this.newnote = 5
       this.sendNote()
     },
     note4etoiles() {
       this.newnote = 4
       this.sendNote()
     },
     note3etoiles() {
       this.newnote = 3
       this.sendNote()
     },
     note2etoiles() {
       this.newnote = 2
       this.sendNote()
     },
     note1etoile() {
       this.newnote = 1
       this.sendNote()
     },
     getNotes() {
       window.axios.get('quizz/'+this.$route.params.id+'/notes')
        .then(response => {
          var self = this
        response.data.notes.forEach(function(element) {
         if (element.id_user === self.$store.state.member.id) {

           self.note = element.valeur
           self.note_id = element.id
         }
       })
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

.rating {
   direction: rtl;
}
.rating a {
   color: #aaa;
   text-decoration: none;
   font-size: 3em;
   transition: color .4s;
}
.rating a:hover,
.rating a:focus,
.rating a:hover ~ a,
.rating a:focus ~ a {
   color: orange;
   cursor: pointer;
}

h1,h2{

text-align: center;

}

.chat{
width: 90%

}
</style>
