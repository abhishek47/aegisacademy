<?php

namespace App;

use App\Models\Wiki;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function readWikis()
    {
        return $this->belongsToMany(Wiki::class, 'wiki_read')->withTimeStamps();
    }

    public function ratedWikis()
    {
        return $this->belongsToMany(Wiki::class, 'wiki_rating')->withTimeStamps()->withPivot('rating');
    }

    public function hasRead(Wiki $wiki)
    {
        return $this->readWikis->contains($wiki);
    }

    public function ratingFor(Wiki $wiki)
    {
        return $this->ratedWikis->contains($wiki) ? $this->ratedWikis()->where('wiki_id', $wiki->id)->first()->pivot->rating  : 0;
    }


}
