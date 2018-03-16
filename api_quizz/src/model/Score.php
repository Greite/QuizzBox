<?php
/**
 *
 */
namespace quizz\model;

class Quizz extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'score';
    protected $primaryKey = 'id';
    public $timestamps = false;

}