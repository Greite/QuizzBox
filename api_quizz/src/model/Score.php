<?php
/**
 *
 */
namespace quizz\model;

class Score extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'score';
    protected $primaryKey = 'id';
    public $timestamps = false;

}