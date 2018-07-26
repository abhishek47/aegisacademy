<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Topic extends Model
{
    use CrudTrait;

    protected $table = 'topics';
    protected $fillable = ['name', 'subject_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function problems()
    {
        return $this->hasMany(Problem::class);
    }

    public function getNameWithSubjectAttribute()
    {
        return $this->name . ' --> ' . $this->subject->name;
    }
}
