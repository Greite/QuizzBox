<?php
/**
 *
 */
namespace quizz\model;

class Quizz extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'quizz';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = "string";

  public function themes() {
    return $this->belongsToMany('quizz\model\Theme', 'theme2quizz', 'id_quizz', 'id_theme');
	}

  public function questions() {
    return $this->hasMany('quizz\model\Question', 'id_quizz');
  }

	public function createur() {
    return $this->belongsTo('quizz\model\User', 'id_createur');
	}
}