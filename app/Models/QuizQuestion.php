<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class QuizQuestion extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'quiz_questions';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
     protected $fillable = ['q', 'a', 'select_any', 'correct', 'incorrect', 'quiz_id', 'level', 'solution', 'source'];

     protected $visible = ['id', 'q', 'a', 'select_any', 'correct', 'incorrect', 'level', 'source'];

     //protected $appends = ['solved', 'solved_correct', 'user_answers'];
}
