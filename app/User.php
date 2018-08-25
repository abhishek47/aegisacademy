<?php

namespace App;

use App\Models\Wiki;
use App\Models\Discussion;
use App\Models\ThreadReply;
use App\Models\ProblemQuestion;
use App\Models\ProblemQuestionSolution;
use Illuminate\Notifications\Notifiable;
use App\Models\BookChapterQuestion;
use App\Models\BookChapterQuestionSolution;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }


    public function readWikis()
    {
        return $this->belongsToMany(Wiki::class, 'wiki_read', 'user_id')->withTimeStamps();
    }

    public function ratedWikis()
    {
        return $this->belongsToMany(Wiki::class, 'wiki_rating', 'user_id')->withTimeStamps()->withPivot('rating');
    }

    public function likedReplies()
    {
        return $this->belongsToMany(ThreadReply::class, 'user_reply', 'user_id')->withTimeStamps();
    }

    public function solutionUpvotes()
    {
        return $this->belongsToMany(ProblemQuestionSolution::class, 'pquestion_solution_upvotes', 'user_id');
    }

    public function chapterSolutionUpvotes()
    {
        return $this->belongsToMany(BookChapterQuestionSolution::class, 'cquestion_solution_upvotes', 'user_id', 'cquestion_solution_id');
    }



    public function solvedProblemQuestions()
    {
        return $this->belongsToMany(ProblemQuestion::class, 'user_problem_questions', 'user_id')->withTimeStamps()->withPivot(['answer', 'is_correct']);
    }

     public function solvedBookQuestions()
    {
        return $this->belongsToMany(BookChapterQuestion::class, 'user_book_questions', 'user_id')->withTimeStamps()->withPivot(['answer', 'is_correct']);
    }

    public function hasRead(Wiki $wiki)
    {
        return $this->readWikis->contains($wiki);
    }

    public function ratingFor(Wiki $wiki)
    {
        return $this->ratedWikis->contains($wiki) ? $this->ratedWikis()->where('wiki_id', $wiki->id)->first()->pivot->rating  : 0;
    }

    public function answerFor(ProblemQuestion $question)
    {
        return $this->solvedProblemQuestions->contains($question) ? $this->solvedProblemQuestions()->where('problem_question_id', $question->id)->first()->pivot->answer  : null;
    }


    public function isCreaterOf($model)
    {
        return $model->user_id == $this->id;
    }




}
