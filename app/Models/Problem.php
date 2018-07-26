<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Problem extends Model
{
   use CrudTrait;

   protected $table = 'problems';
   protected $fillable = ['title', 'description', 'subject_id', 'topic_id', 'level', 'slug'];

   protected $levels = ['Beginner', 'Intermidiate', 'Advance'];


   protected $with = ['questions'];

   public function questions()
   {
       return $this->hasMany(ProblemQuestion::class);
   }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function topic()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getLevelAttribute($value)
    {
        return $this->levels[$value];
    }

    public function getIsOngoingAttribute()
    {
        foreach ($this->questions()->pluck('id') as $key => $id) {
            if(auth()->user()->solvedProblemQuestions->contains($id)){
              return true;
            }
        }
        return false;
    }

    public function getIsCompleteAttribute()
    {
        foreach ($this->questions()->pluck('id') as $key => $id) {
          if(!auth()->user()->solvedProblemQuestions->contains($id)){
            return false;
          }
        }
        return true;
    }
}
