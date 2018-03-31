<?php
/**
 *
 */
namespace quizz\model;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = "string";

    public function quizz() {
       return $this->hasMany('quizz\model\Quizz', 'id_createur');
	  }

    public function commentaires() {
      return $this->hasMany('quizz\model\Commentaire', 'id_auteur');
    }

    public function notes() {
      return $this->hasMany('quizz\model\Note', 'id_user');
    }

}
