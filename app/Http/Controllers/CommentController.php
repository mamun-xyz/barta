<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{   

    public function StoreComment($post_id)
    {   
        $description = request()->comment;
        //post uuid to redirect user single post page
        $uuid = DB::table('posts')
                    ->where('id', $post_id)
                    ->value('uuid'); 

        $user_id = Auth::user()->id;                      

        DB::table('comments')->insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'description' => $description,     
        ]);

        return redirect('/single-post/' . $uuid);   
    }


    public function UpdateComment($comment_id)
    {
       $comment_data = DB::table('comments')
                            ->where('id', $comment_id)
                            ->first(['id', 'description']);

        return view('edit-comment')
                    ->with('comment_data', $comment_data);                 
    }

    public function StoreUpdateComment($comment_id)
    {
       $description = request()->comment;

       DB::table('comments')
                ->where('id', $comment_id)
                ->update([
                    'description' => $description,
                ]); 
        
        //post uuid to redirect
        $post_id = DB::table('comments')
                    ->where('id', $comment_id)
                    ->value('post_id');
        $uuid =DB::table('posts')
                    ->where('id',  $post_id)
                    ->value('uuid');            
                
        echo "<h2>Comment Updated</h2>";           
        ob_flush();
        flush();
        sleep(1);    
        return redirect('/single-post/' . $uuid);                
    }


    public function DeleteComment($comment_id)
    {
        DB::table('comments')
            ->where('id', $comment_id)
            ->delete();

        echo "<h2>Comment Deleted</h2>";           
        ob_flush();
        flush();
        sleep(1);    
        return redirect()->back();   
    }

}
