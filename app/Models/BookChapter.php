<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use App\Models\BookChapterQuestion;
use Illuminate\Database\Eloquent\Model;

class BookChapter extends Model
{
    use CrudTrait;

    protected $table = 'book_chapters';
    protected $fillable = ['name', 'book_id', 'description'];

    protected $levels = ['Beginner', 'Intermidiate', 'Advance'];


   protected $with = ['questions'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }


   public function questions()
   {
       return $this->hasMany(BookChapterQuestion::class, 'chapter_id');
   }

    public function getBookNameAttribute()
    {
        return $this->book->title;
    }



}