<?php
/**
 *
 */
namespace quizz\model;

class Question extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'question';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function quizz() {
       return $this->belongsTo('quizz\model\Quizz', 'id_quizz');
	}

	public function reponses() {
       return $this->hasMany('quizz\model\Reponse', 'id_question');
	}
}