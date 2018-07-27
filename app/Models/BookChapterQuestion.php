<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class BookChapterQuestion extends Model
{
    use CrudTrait;

    protected $table = 'book_chapter_questions';
    protected $fillable = ['question', 'options', 'solution', 'level', 'hint' ,'answer', 'chapter_id'];

      protected $appends = ['user_answer', 'is_solved_correct', 'solvings_count', 'solutions_count'];

    public function solutions()
    {
        return $this->hasMany(BookChapterQuestionSolution::class);
    }

    public function chapter()
    {
        return $this->belongsTo(BookChapter::class);
    }

    public function getOptionsAttribute()
    {
        return json_decode($this->attributes['options'], true);
    }

     public function solvers()
    {
        return $this->belongsToMany(User::class, 'user_book_questions')->withTimeStamps()->withPivot(['answer', 'is_correct']);
    }

    public function getUserAnswerAttribute()
    {
        return auth()->user()->solvedProblemQuestions->contains($this) ? auth()->user()->solvedBookQuestions()->where('book_chapter_question_id', $this->id)->first()->pivot->answer  : null;
    }

    public function getIsSolvedCorrectAttribute()
    {
        return auth()->user()->solvedProblemQuestions->contains($this) ? auth()->user()->solvedProblemQuestions()->where('book_chapter_question_id', $this->id)->first()->pivot->is_correct  : null;
    }

    public function getSolvingsCountAttribute()
    {
        return $this->solvers->count();
    }


    public function getSolutionsCountAttribute()
    {
        return 0;
    }
}
