<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiVietLinhVuc extends Model
{
    use HasFactory;
    protected $table = 'baivietlinhvuc';

    public function linhvuc()
    {
        return $this->belongsTo('App\Models\LinhVuc', 'id_linhvuc', 'id');
    }
    public function comment()
    {
        return $this->hasMany('App\Models\CommentLinhVuc', 'id_linhvuc', 'id');
    }
}
