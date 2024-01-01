<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{   

    public function StoreComment($post_id)
    {   
        $description = request()->comment;
       
        $post_uuid = Post::where('id', $post_id)
                         ->value('post_uuid'); 

        $user_id = Auth::user()->id;                      

        Comment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'description' => $description,     
        ]);

        return redirect('/single-post/' . $post_uuid);   
    }


    public function UpdateComment($comment_id)
    {
       $comment_data = Comment::where('id', $comment_id)
                               ->first(['id', 'description']);

        return view('edit-comment')
                    ->with('comment_data', $comment_data);                 
    }

    public function StoreUpdateComment($comment_id)
    {
       $description = request()->comment;

      Comment::where('id', $comment_id)
                ->update([
                    'description' => $description,
                ]); 
        
        $post_id = Comment::where('id', $comment_id)
                          ->value('post_id');
        $post_uuid =  Post::where('id',  $post_id)
                          ->value('post_uuid');            
                
        echo "<h2>Comment Updated</h2>";           
        ob_flush();
        flush();
        sleep(1);    
        return redirect('/single-post/' . $post_uuid);                
    }


    public function DeleteComment($comment_id)
    {
        Comment::where('id', $comment_id)
                ->delete();

        echo "<h2>Comment Deleted</h2>";           
        ob_flush();
        flush();
        sleep(1);    
        return redirect()->back();   
    }

}
