<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table = 'tintuc';
    public function comment()
    {
        return $this->hasMany('App\Models\CommentTinTuc', 'id_tintuc', 'id');
    }
}
