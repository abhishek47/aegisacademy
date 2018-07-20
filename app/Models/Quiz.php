<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Quiz extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'quizzes';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];

    protected $fillable = ['name', 'main'];

    protected $with = ['questions'];

    protected $visible = ['id', 'name', 'main', 'questions'];

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    } 

     public function manageQuestions($crud = false)
    { 
     
      
        return '<a class="btn btn-xs btn-success" href="/admin/questions/quiz:' . $this->id . '" data-toggle="tooltip" title="Manage Questions">Questions</a>';
       
    }

   
    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge(['info' => $this->attributesToArray()], $this->relationsToArray(),
                           ['levels' => $this->questions->groupBy('level')->count()]);
    }

    
}
