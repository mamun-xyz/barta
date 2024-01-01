<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class ProfileController extends Controller
{
    public function Profile(Request $request, $user_uuid)
    {      
        if(Auth::check())
        {
            $id = User::where('user_uuid', $user_uuid)->value('id');
                             
            $total_post = Post::where('user_id', $id)->count();

            $total_comment = Comment::where('user_id', $id)->count();            
                                         
            if( $total_post !== 0 )
            {
                $current_user_id = Auth::user()->id;

                $user_info = User::where('id', $id)
                                 ->get();

                $post_info = Post::where('user_id', $id)                                
                                  ->orderBy('posts.created_at', 'desc')
                                  ->get();                                           
  
                return view('profile')
                        ->with('user_info', $user_info)
                        ->with('post_info',  $post_info)
                        ->with('total_post', $total_post)
                        ->with('total_comment', $total_comment)  
                        ->with('current_user_id', $current_user_id); 
                                       
            }else
            {
                $user_info = User::where('id', $id)
                                  ->get();   
                                                         
                return view('profile')
                        ->with('user_info', $user_info)
                        ->with('total_post', $total_post)                             
                        ->with('total_comment', $total_comment);                          
            }
        }
            return redirect("login")->withSuccess('Opps! You do not have access');       
    }

}
