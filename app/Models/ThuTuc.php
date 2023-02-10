<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuTuc extends Model
{
    use HasFactory;
    protected $table = 'thutuc';
    public function comment()
    {
        return $this->hasMany('App\Models\CommentThuTuc', 'id_thutuc', 'id');
    }
}
