<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLinhVuc extends Model
{
    use HasFactory;
    protected $table = 'commentlinhvuc';
   
    public function baivietlinhvuc()
    {
        return $this->belongsTo('App\Models\BaiVietLinhVuc', 'id_baivietlinhvuc', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
}
