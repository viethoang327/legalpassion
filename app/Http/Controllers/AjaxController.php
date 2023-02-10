<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinhVuc;

class AjaxController extends Controller
{
    //
    public function getLinhVuc($idLinhVuc)
    {
        $vande = LinhVuc::where('id_loailinhvuc', $idLinhVuc)->get();
        foreach($vande as $vd)
        {
            echo "<option value='".$vd->id."'>".$vd->ten."</option>";
        }
    }
    
}
