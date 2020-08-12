<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Logdata;
use App\Users;

class SOSController extends Controller
{
    //

    public function tryindex(){
        return view('try');
    }

    // Laravel -> Vue API
    public function send_json(){
        $data=Logdata::all();
        return response()->json([
            'data' => $data
        ]);
    }

   // Vue -> Laravel API
    public function vue_json(Request $request){
        $savedb = new Logdata;
        $savedb->userid = Auth::user()->id;
        $savedb->deviceid = $request['deviceid'];
        $savedb->latitude = $request['latitude'];
        $savedb->longtitude = $request['longtitude'];
        $savedb->save();
        return redirect('/try');
    }

    // SearchAPI
    public function search_api(Request $request){
        $log= Logdata::select('logid','deviceid','latitude','longtitude')->get(); 
        $logdata=[];
        foreach ($log as $value){
            if($value->deviceid == $request['deviceid']){
                array_push($logdata,$value);
            }
        }
        return response()->json([
            'logdata'=>$logdata
        ]);
    }

    // DestroyAPI
    public function destroy_api(Request $request){
        Logdata::destroy((int)$request['logid']);
        return back();
    }


    public function email(Request $request){
        $data=Users::find($request['id']);
        return response()->json([
            'data' => $data->email
        ]);
    }



}
