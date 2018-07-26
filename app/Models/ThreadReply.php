<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ThreadReply extends Model
{
    protected $fillable = ['body', 'user_id', 'thread_id'];

    protected $appends = ['is_mine', 'likes_string', 'likes_count', 'is_liked', 'is_best'];

    protected $with = ['user', 'thread'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Discussion::class, 'discussion_id');
    }

    public function getIsMineAttribute()
    {
        return $this->user_id == auth()->id();
    }

    public function likers()
    {
        return $this->belongsToMany(User::class, 'user_reply')->withTimeStamps();
    }

    public function getLikesStringAttribute()
    {
        if($this->likers->count())
        {
            if($this->likers->contains(auth()->user()))
            {
                if($this->likers->count() == 1)
                {
                     return  '<b class="font-semibold">You</b> liked this';
                 } else {
                     return '<b class="font-semibold">You</b> and <b class="font-semibold">' . $this->likers->count()  . '</b> others liked this' ;
                 }
            } else {
                return '<b class="font-semibold">' . $this->likers->count() . '</b> others liked this';
            }

        } else {
            return 'No likes yet';
        }

    }

    public function getLikesCountAttribute()
    {
        return $this->likers->count();
    }

    public function getIsBestAttribute()
    {
        return $this->id == $this->thread->best_reply_id;
    }

    public function getIsLikedAttribute()
    {
        return $this->likers->contains(auth()->user());
    }

}
