<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentTinTuc extends Model
{
    use HasFactory;
    protected $table = 'commenttintuc';
    public function tintuc()
    {
        return $this->belongsTo('App\Models\TinTuc', 'id_tintuc', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
    
}
