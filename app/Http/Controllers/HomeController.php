<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
     public function Home(Request $request)
     {
        if (Auth::check()) 
        {    
            $current_user_id = (Auth::user()->id);

            $user_first_name = (Auth::user()->firstname);

            $data = Post::with('user')->orderBy('posts.created_at', 'desc')->get();
                                                    
            return view('home')
                        ->with('data', $data)
                        ->with('user_first_name',  $user_first_name)
                        ->with('current_user_id', $current_user_id)
                        ->withSuccess('You have Successfully loggedin');           
        }else{
               return view('auth.login');
        }

     }
}
