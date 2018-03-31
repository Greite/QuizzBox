<?php
/**
 *
 */
namespace quizz\model;

class Note extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'note';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = "string";

    public function quizz() {
      return $this->belongsTo('quizz\model\Quizz', 'id_quizz');
  	}

	  public function auteur() {
      return $this->belongsTo('quizz\model\User', 'id_user');
	  }
}
