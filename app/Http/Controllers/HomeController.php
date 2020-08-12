<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    // API ขอชื่อแสงบน navbar
    public function getname_navbar(Request $request){
        $id=Auth::user()->id;
        $name=Users::find($id)->name;
        return response()->json([
            'name' => $name
        ]);
    }



}
