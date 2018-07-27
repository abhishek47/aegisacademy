<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class BookChapterQuestion extends Model
{
    use CrudTrait;

    protected $table = 'book_chapter_questions';
    protected $fillable = ['question', 'options', 'solution', 'level', 'hint' ,'answer', 'chapter_id'];

    protected $appends = ['solutions_count'];

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

    public function getSolutionsCountAttribute()
    {
        return 0;
    }
}
