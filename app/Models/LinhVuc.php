<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinhVuc extends Model
{
    use HasFactory;
    protected $table = 'linhvuc';

    public function loailinhvuc()
    {
        return $this->belongsTo('App\Models\LoaiLinhVuc', 'id_loailinhvuc', 'id');
    }
    public function baivietlinhvuc()
    {
        return $this->hasMany('App\Models\BaiVietLinhVuc', 'id_linhvuc', 'id');
    }
}
