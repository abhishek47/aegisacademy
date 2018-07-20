<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

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

    public function getUrlAttribute()
    {
        return 'wiki/' . $this->slug;
    }
}
