<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
    use HasFactory;
    protected $table = 'replycomment';
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
    public function commentlinhvuc()
    {
        return $this->belongsTo('App\Models\CommentLinhVuc', 'id_comment', 'id');
    }
}
