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
            $id = json_decode((request()->id), true);
            $user_info = DB::table('users')
                            ->find($id);
        return view('edit-profile')->with('user_info', $user_info);
        }else{
            return redirect('login');
        }
    }
}
