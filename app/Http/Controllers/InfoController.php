<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Userinfo;



class InfoController extends Controller
{
    //

    public function index($id){
        $info = Userinfo::find($id);
        return view ('info',[
            'info'=>$info
        ]);
    }

    


}