<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function Search(Request $request)
    {
        $query = $request->input('query');
        
        $user_uuid = User::where('firstname', 'LIKE',  $query )
                         ->orWhere('lastname', 'LIKE', $query )
                         ->orWhere('user_name', 'LIKE', $query )
                         ->orWhere('email', 'LIKE', $query )
                         ->value('user_uuid');

        if(!empty( $user_uuid ))
        {
           return redirect('/profile/' . $user_uuid);

        }else
        {
           return view('no-result');
        }
    }
}
