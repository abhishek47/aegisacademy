<?php

namespace App;

use App\Models\Wiki;
use App\Models\Discussion;
use App\Models\ThreadReply;
use App\Models\ProblemQuestion;
use App\Models\ProblemQuestionSolution;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        return $this->belongsToMany(Wiki::class, 'wiki_read')->withTimeStamps();
    }

    public function ratedWikis()
    {
        return $this->belongsToMany(Wiki::class, 'wiki_rating')->withTimeStamps()->withPivot('rating');
    }

    public function likedReplies()
    {
        return $this->belongsToMany(ThreadReply::class, 'user_reply')->withTimeStamps();
    }

    public function solutionUpvotes()
    {
        return $this->belongsToMany(ProblemQuestionSolution::class, 'pquestion_solution_upvotes');
    }

    public function solvedProblemQuestions()
    {
        return $this->belongsToMany(ProblemQuestion::class, 'user_problem_questions')->withTimeStamps()->withPivot(['answer', 'is_correct']);
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
