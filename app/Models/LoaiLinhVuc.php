<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiLinhVuc extends Model
{
    use HasFactory;
    protected $table = 'loailinhvuc';

    public function linhvuc()
    {
        return $this->hasMany('App\Models\LinhVuc', 'id_loailinhvuc', 'id');
    }
    public function baivietlinhvuc()
    {
        return $this->hasManyThrough('App\Models\BaiVietLinhVuc', 'App\Models\LinhVuc', 'id_loailinhvuc', 'id_linhvuc', 'id');
    }
}
