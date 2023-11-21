<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    public function Profile(Request $request, $uuid)
    {      
        if(Auth::check())
        {
            $id = DB::table('users')
                      ->where('uuid', '=', $uuid)
                      ->get('id');
            $id =$id->pluck('id')->first();

            $total_post = DB::table('posts')
                              ->join('users', 'posts.user_id', '=', 'users.id')
                              ->where('user_id', $id)
                              ->count();

            if( $total_post == 0 )
            {
                $user_info = DB::table('users')
                                 ->where('id', $id)
                                 ->get([
                                    'id AS user_id',
                                    'uuid AS user_uuid',
                                    'user_name',
                                    'firstname',
                                    'lastname',
                                    'bio',
                                ]);

                return view('profile')
                        ->with('user_info', $user_info)
                        ->with('total_post', $total_post);                 
            }else
            {
                $user_info = DB::table('posts')
                                 ->join('users', 'posts.user_id', '=', 'users.id')
                                 ->where('user_id', $id)
                                 ->select('users.id AS user_id', 'users.uuid AS user_uuid', 'users.user_name', 'users.firstname', 'users.lastname', 'users.bio', 'posts.uuid AS post_uuid', 'posts.*')
                                 ->orderBy('posts.created_at', 'desc')
                                 ->get();

                return view('profile')
                        ->with('user_info', $user_info)
                        ->with('total_post', $total_post);
            }
        }
            return redirect("login")->withSuccess('Opps! You do not have access');       
    }

}
