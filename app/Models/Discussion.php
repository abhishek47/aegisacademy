<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

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
}
