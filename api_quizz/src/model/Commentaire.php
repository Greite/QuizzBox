<?php
/**
 *
 */
namespace quizz\model;

class Commentaire extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'commentaire';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = "string";

    public function quizz() {
      return $this->belongsTo('quizz\model\Quizz', 'id_quizz');
  	}

	  public function auteur() {
      return $this->belongsTo('quizz\model\User', 'id_auteur');
	  }
}
