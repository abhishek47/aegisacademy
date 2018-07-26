<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Discussion extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(ThreadReply::class);
    }

    public function markBestReply(ThreadReply $reply)
    {
        $this->best_reply_id = $reply->id;

        $this->save();
    }

    public function getIsClosedAttribute()
    {
        return $this->best_reply_id != 0;
    }

    public function scopeClosed (Builder $query) {
        return $query->where('best_reply_id', '!=' , 0);
    }

    public function scopePopular (Builder $query) {
        return $query->has('replies', '>' , 5);
    }

    public function scopeUnanswered (Builder $query) {
        return $query->has('replies', '==' , 0);
    }

}
