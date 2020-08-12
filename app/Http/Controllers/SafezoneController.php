<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Safezone;
use App\users;

class SafezoneController extends Controller
{
    //

    //Get Safezone API
    public function get_safezone(Request $request){
        $temp = Auth::user()->id;
        $data=Safezone::all();
        $logdata=[];
        foreach ($data as $value){
            if($value->userid == $temp){
                array_push($logdata,$value);
        }
    }
        return response()->json([
            'data'=>$logdata
        ]);
    }

    //Add Safezone API
    public function add_safezone(Request $request){
        $savedb = new Safezone;
        $savedb->safezonename = $request['safezonename'];
        $savedb->userid = Auth::user()->id;  //เอา primaryKey จาก user ที่ล็อกอินไว้ ใส่ตาราง safezone
        $savedb->radius = $request['radius'];
        $savedb->lat = $request['lat'];
        $savedb->lng = $request['lng'];
        $savedb->save();
        return redirect('/home');
    }

    //Edit Safezone API
    public function edit_safezone(Request $request){
        $editdb = Safezone::find($request['id']);
        $editdb->safezonename = $request['safezonename'];
        $editdb->radius = $request['radius'];
        $editdb->save();
        return back();
    }

    //Delete Safezone API
    public function delete_safezone(Request $request){
        Safezone::destroy($request['id']);
        return back();
    }


}
