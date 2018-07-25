<?php

namespace App\Models;

use App\User;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ProblemQuestion extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'problem_questions';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['question', 'options', 'solution', 'level', 'hint' ,'answer', 'problem_id'];
    // protected $hidden = [];
    // protected $dates = [];

    protected $appends = ['user_answer', 'is_solved_correct', 'solvings_count', 'solutions_count'];

    public function solutions()
    {
        return $this->hasMany(ProblemQuestionSolution::class);
    }

    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }

    public function getOptionsAttribute()
    {
        return json_decode($this->attributes['options'], true);
    }

    public function solvers()
    {
        return $this->belongsToMany(User::class, 'user_problem_questions')->withTimeStamps()->withPivot(['answer', 'is_correct']);
    }

    public function getUserAnswerAttribute()
    {
        return auth()->user()->solvedProblemQuestions->contains($this) ? auth()->user()->solvedProblemQuestions()->where('problem_question_id', $this->id)->first()->pivot->answer  : null;
    }

    public function getIsSolvedCorrectAttribute()
    {
        return auth()->user()->solvedProblemQuestions->contains($this) ? auth()->user()->solvedProblemQuestions()->where('problem_question_id', $this->id)->first()->pivot->is_correct  : null;
    }

    public function getSolvingsCountAttribute()
    {
        return $this->solvers->count();
    }

     public function getSolutionsCountAttribute()
    {
        return $this->solutions->count();
    }
}
