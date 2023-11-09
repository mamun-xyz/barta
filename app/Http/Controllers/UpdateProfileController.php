<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateProfileController extends Controller
{
   public function UpdateInfo(Request $request)
   {
      $id = json_decode((request()->id), true);
      $first_name = implode($request->all('first-name'));
      $last_name = implode($request->all('last-name'));
      $email = implode($request->all('email'));
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
             'bio' => $bio
           ]);
      }
      echo "<h2>Your Information Updated Successfully</h2>";           
      ob_flush();
      flush();
      sleep(1); // Adjust the duration as needed
      return redirect('/profile/'.$id);     
           
   }
}
