<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EditProfileController extends Controller
{
    public function EditProfile()
    {
        if(Auth::check())
        {
            $uuid = request()->uuid;
            $id = DB::table('users')
                      ->where('uuid', '=', $uuid)
                      ->get('id');

            $id =$id->pluck('id')->first();
            $user_info = DB::table('users')
                             ->find($id);

            $user_info = DB::table('users')
                             ->find($id);
                            
            return view('edit-profile')->with('user_info', $user_info);
        }else{
                return redirect('login');
        }
    }
}
