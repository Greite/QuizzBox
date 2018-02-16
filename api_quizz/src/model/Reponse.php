<?php
/**
 *
 */
namespace quizz\model;

class Reponse extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'reponse';
    protected $primaryKey = 'id';
    public $timestamps = false;

	public function question() {
       return $this->belongsTo('quizz\model\Question', 'id_question');
	}
}