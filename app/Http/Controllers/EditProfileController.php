<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EditProfileController extends Controller
{
    public function EditProfile()
    {
        if(Auth::check())
        {
            $user_uuid = request()->user_uuid;
            $id = User::where('user_uuid', '=', $user_uuid)
                      ->value('id');

            $user_info = User::find($id);
                            
            return view('edit-profile')->with('user_info', $user_info);
        }else{
                return redirect('login');
        }
    }
}
