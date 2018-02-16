<?php
/**
 *
 */
namespace quizz\model;

class Theme extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'theme';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = "string";

    public function quizz() {
       return $this->belongsToMany('quizz\model\Quizz', 'theme2quizz', 'id_theme', 'id_quizz');
	}
}