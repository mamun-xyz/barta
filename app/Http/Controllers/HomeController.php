<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class HomeController extends Controller
{
     public function Home(Request $request)
     {
        if (Auth::check()) 
        {    
            $current_user_id = (Auth::user()->id);

            $user_name = (Auth::user()->firstname);

            $data = DB::table('posts')
                         ->join('users', 'posts.user_id', '=', 'users.id')
                         ->select('posts.description', 'posts.view_count', 'posts.uuid AS post_uuid','posts.total_comment', 'users.id', 'users.firstname', 'users.lastname', 'users.user_name', 'users.uuid AS user_uuid',DB::raw('CAST(posts.updated_at AS datetime) as updated_at'))
                         ->orderBy('posts.created_at', 'desc')
                         ->get();                     
                         
            return view('home')
                         ->with('data', $data)
                         ->with('user_name',  $user_name)
                         ->with('current_user_id', $current_user_id)
                         ->withSuccess('You have Successfully loggedin');
            
        }else{
               return view('auth.login');
        }

     }
}
