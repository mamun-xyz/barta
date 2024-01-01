<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateProfileController extends Controller
{
   public function UpdateInfo(Request $request)
   {
      $user_uuid = request()->user_uuid;

      $id = User::where('user_uuid', '=', $user_uuid)
                ->value('id');
                               
      $first_name = implode($request->all('first-name'));
      $last_name = implode($request->all('last-name'));
      $email = implode($request->all('email'));
      $user_name = implode($request->all('user_name'));
      $password = implode($request->all('password'));
      $bio = implode($request->all('bio'));

      $old_image = User::where('user_uuid', '=', $user_uuid)
                        ->value('image');          

      if( $new_image = request()->avatar )
      {
        Storage::delete('public/profile_photo/' . $old_image);
        $path = Storage::putFile('public/profile_photo', request()->avatar);
        $image = str_replace('public/profile_photo/', '', $path);
      }else
      {
        $image = $old_image;
      }

      if(!empty($password)){
              $update_info = User::where('id', $id)
                ->update(
                  [
                    'firstname' => $first_name,
                    'lastname' => $last_name,
                    'email' => $email,
                    'user_name' => $user_name,
                    'password' => Hash::make($password),
                    'bio' => $bio,
                    'image' => $image,
                  ]);
      }else{
         $update_info = User::where('id', $id)
          ->update(
            [
              'firstname' => $first_name,
              'lastname' => $last_name,
              'email' => $email,
              'user_name' => $user_name,
              'bio' => $bio,
              'image' => $image,
            ]);
      }
      
      $user_uuid = request()->user_uuid;
      echo "<h2>Your Information Updated Successfully</h2>";           
      ob_flush();
      flush();
      sleep(1); // Adjust the duration as needed
      return redirect('/profile/'.$user_uuid);             
   }
}
