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
               return view('home')
               ->withSuccess('You have Successfully loggedin');
        }else{
             return redirect('/login');
        }

     }
}
