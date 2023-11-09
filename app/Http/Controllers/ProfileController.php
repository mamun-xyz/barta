<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class ProfileController extends Controller
{
    public function Profile(Request $request)
    {       
        if(Auth::check()){
           $id = json_decode((request()->id), true);
           $user_info = DB::table('users')
                ->find($id);
           return view('profile')->with('user_info', $user_info);
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

}
