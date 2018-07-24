<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class WikiCategory extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'wiki_categories';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name'];
    // protected $hidden = [];
    // protected $dates = [];

   public function wikis()
   {
        return $this->hasMany(Wiki::class, 'wiki_category_id');
   }

   public function color()
   {
        return $this->belongsTo(Color::class, 'color_id');
   }

   public function getCountAttribute()
   {
        return count($this->wikis);
   }
}
