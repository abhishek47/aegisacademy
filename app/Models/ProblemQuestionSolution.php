<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProblemQuestionSolution extends Model
{

    protected $fillable = ['body', 'problem_question_id', 'user_id'];

    protected $with = ['user'];

    protected $appends = ['upvoted', 'upvotes', 'is_mine'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function upvoters()
    {
        return $this->belongsToMany(User::class, 'pquestion_solution_upvotes');
    }

    public function question()
    {
        return $this->belongsTo(ProblemQuestion::class);
    }

    public function getUpvotedAttribute()
    {
        return auth()->user()->solutionUpvotes->contains($this);
    }

    public function getUpvotesAttribute()
    {
        return $this->upvoters->count();
    }

    public function getIsMineAttribute()
    {
        return $this->user_id == auth()->id();
    }
}
