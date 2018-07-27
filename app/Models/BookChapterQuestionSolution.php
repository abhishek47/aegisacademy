<?php

namespace App\Models;

use App\User;
use App\Models\BookChapterQuestion;
use Illuminate\Database\Eloquent\Model;

class BookChapterQuestionSolution extends Model
{
    protected $fillable = ['body', 'book_chapter_question_id', 'user_id'];

    protected $with = ['user'];

    protected $appends = ['upvoted', 'upvotes', 'is_mine'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function upvoters()
    {
         return $this->belongsToMany(User::class, 'cquestion_solution_upvotes', 'cquestion_solution_id', 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(BookChapterQuestion::class);
    }

    public function getUpvotedAttribute()
    {
        return auth()->user()->chapterSolutionUpvotes->contains($this);
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
