<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateProfileController extends Controller
{
   public function UpdateInfo(Request $request)
   {

      $uuid = request()->uuid;
      $id = DB::table('users')
                ->where('uuid', '=', $uuid)
                ->get('id');
      $id =$id->pluck('id')->first();
                 
      $uuid = implode($request->all('uuid'));
      $first_name = implode($request->all('first-name'));
      $last_name = implode($request->all('last-name'));
      $email = implode($request->all('email'));
      $user_name = implode($request->all('user_name'));
      $password = implode($request->all('password'));
      $bio = implode($request->all('bio'));

      if(!empty($password)){
              $update_info = DB::table('users')
              ->where('id', $id)
              ->update(
                [
                  'firstname' => $first_name,
                  'lastname' => $last_name,
                  'email' => $email,
                  'user_name' => $user_name,
                  'password' => Hash::make($password),
                  'bio' => $bio
                ]);
      }else{
         $update_info = DB::table('users')
         ->where('id', $id)
         ->update(
           [
             'firstname' => $first_name,
             'lastname' => $last_name,
             'email' => $email,
             'user_name' => $user_name,
             'bio' => $bio
           ]);
      }
      
      $uuid = request()->uuid;
      echo "<h2>Your Information Updated Successfully</h2>";           
      ob_flush();
      flush();
      sleep(1); // Adjust the duration as needed
      return redirect('/profile/'.$uuid);             
   }
}
