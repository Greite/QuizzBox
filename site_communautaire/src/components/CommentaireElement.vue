<template>



  <li v-if="!modif">

    <span v-for="user of users" v-if="commentaire.id_auteur === user.id">{{user.login}}</span>
  </br>
    <span>{{commentaire.message}}</span>



    <span v-if="commentaire.id_auteur === $store.state.member.id">
      </br>
      <button @click="modification" class="btn btn-outline-warning">Modifier</button>
      <button @click="deletePost(commentaire.id)" class="btn btn-outline-danger">Supprimer</button>
    </span>
  </li>

  <li v-else>

    <span v-for="user of users" v-if="commentaire.id_auteur === user.id">{{user.login}}</span>

    <input type="text" v-model="messageModif" @keyup.enter="modifPost(commentaire.id)" @keyup.escape="modification">

    <button @click="modification" class="btn btn-outline-secondary">Annuler</button>

  </li>

</template>

<script>
export default {
  name: 'CommentaireElement',
  props: ['commentaire'],
  data () {
    return {
      modif: false,
      messageModif: "",
      users: [],
      user: '',
    }
  },
  mounted() {
    window.axios.get('users')
    .then(response => {
      this.users = response.data.users
    })
    .catch(e => {
      this.errors.push(e)
    })
  },
  methods: {
    deletePost(id) {
      window.axios.delete('quizz/'+this.$route.params.id+'/commentaires/'+id, {headers:  {'Authorization': 'Bearer ' + this.$store.state.member.token }}).then(response => {
        window.bus.$emit('rechargerMessage')
      })
    },
    modification(){
        if (this.modif) {
          this.modif=false
        }
        else {
          this.modif=true
          this.messageModif = this.commentaire.message
        }
    },
    modifPost(id){
      window.axios.put('quizz/'+this.$route.params.id+'/commentaires/'+id, {
        message: this.messageModif
      }, {headers:  {'Authorization': 'Bearer ' + this.$store.state.member.token }}).then(response => {
         this.modif=false;
         this.commentaire.message=this.messageModif
      })
    }
  }
}
</script>

<style scoped>
  p{

    text-align: center;


  }


</style>
