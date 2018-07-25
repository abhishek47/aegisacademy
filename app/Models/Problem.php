<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Problem extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

   protected $table = 'problems';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
   protected $fillable = ['title', 'description'];
    // protected $hidden = [];
    // protected $dates = [];

   protected $with = ['questions'];

   public function questions()
   {
       return $this->hasMany(ProblemQuestion::class);
   }
}
