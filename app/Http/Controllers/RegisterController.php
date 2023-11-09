<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function Register()
    {
        return view('auth.register');
    }

    public function StoreRegister(Request $request)
    {   
     DB::table('users')->insert([
        'firstname' => implode($request->all('first_name')),
        'lastname' =>  implode($request->all('last_name')),
        'email' => implode($request->all('email')),
        'password' =>  Hash::make(implode($request->all('password')))
    ]);

      echo "<h2>Successfully Your Acount Created</h2>";           
      ob_flush();
      flush();
      sleep(1); // Adjust the duration as needed       
      return redirect('login');
    }  
}
