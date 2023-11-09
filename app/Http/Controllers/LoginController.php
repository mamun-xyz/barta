<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class LoginController extends Controller
{
    public function Login(Request $request)
    {   
        if (Auth::check()) 
        {
            return redirect()->intended('/')
            ->withSuccess('You have Successfully loggedin');
                                    
        }else{
            return view('auth.login');
        }             
    }

    public function LoginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);       
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) 
        {
            $user_email = $request->only('email');
            $id = DB::table('users')
                    ->where('email', '=', $user_email)
                    ->value('id');                 
            return redirect('/');
        }    
      echo "<h2>Oppes! You have entered invalid credentials</h2>";           
      ob_flush();
      flush();
      sleep(1); // Adjust the duration as needed       
      return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function Logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
