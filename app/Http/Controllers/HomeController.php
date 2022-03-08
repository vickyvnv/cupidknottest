<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        // List all match preference
        $matchList = User::where('gender', '!=', Auth::user()->gender)
                    ->where('id', '!=', Auth::user()->id)
                    ->where('is_admin', 0)
                    ->where('occupation', Auth::user()->occupation)
                    ->where('family_type', Auth::user()->family_type)
                    ->get();
    
        $allUser = [];

        if(Auth::user()->is_admin == 1) {
            $allUser = User::get();
        }
                
        return view('home', compact('matchList', 'allUser'));
    }
}
