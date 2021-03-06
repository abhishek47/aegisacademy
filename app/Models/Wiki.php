<?php

namespace App\Models;

use App\User;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'wikis';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title', 'body', 'wiki_category_id'];
    // protected $hidden = [];
    // protected $dates = [];


    public function category()
    {
        return $this->belongsTo(WikiCategory::class, 'wiki_category_id');
    }
    public function readers()
    {
        return $this->belongsToMany(User::class, 'wiki_read')->withTimeStamps();
    }

    public function ratings()
    {
        return $this->belongsToMany(User::class, 'wiki_rating')->withTimeStamps()->withPivot('rating');
    }

    public function getRatingAttribute()
    {
        return \DB::table('wiki_rating')->where('wiki_id', $this->id)
                                       ->avg('rating');
    }

    public function getReadingsAttribute()
    {
        return $this->readers->count();
    }

    public function getUrlAttribute()
    {
        return 'wiki/' . $this->slug;
    }
    public function manageQuestions()
    {
        return '<a class="btn btn-xs btn-primary"   href="/admin/wiki-problem-questions?wiki=' . $this->id . '" data-toggle="tooltip" title="Manage Problem Questions">Manage Questions</a>';
    }
}
