<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentThuTuc extends Model
{
    use HasFactory;
    protected $table = 'commentthutuc';
    public function thutuc()
    {
        return $this->belongsTo('App\Models\ThuTuc', 'id_thutuc', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
}
