<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function StorePost(Request $request, $uuid)
    {
        $user_id = DB::table('users')
                       ->where('uuid', '=', $uuid)
                       ->get('id');
        $user_id  =$user_id ->pluck('id')->first();

        $uuid = Uuid::uuid4()->toString();
        DB::table('posts')->insert([
            'user_id' => $user_id,
            'uuid' => $uuid,
            'description' => implode($request->all('barta')),
        ]);

        echo "<h2>Successfully You Post</h2>";           
        ob_flush();
        flush();
        sleep(1); 
        return redirect('/');
    }
    
    public function SinglePost()
    {
        $uuid = request()->uuid;
        $data = DB::table('posts')
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->select('posts.id AS post_id', 'posts.description', 'posts.view_count', 'users.id AS user_id', 'users.uuid AS user_uuid', 'posts.uuid', 'users.firstname', 'users.lastname', 'users.user_name', DB::raw('CAST(posts.created_at AS datetime) as created_at'))
                    ->where('posts.uuid', $uuid)
                    ->orderBy('posts.created_at', 'desc')
                    ->get();  

        $post_id = DB::table('posts')->where('uuid', $uuid)->value('id');
        $comment_data = DB::table('comments')
                       ->where('post_id', $post_id)
                       ->join('users', 'comments.user_id', '=', 'users.id')
                       ->select('comments.id','comments.user_id','comments.description', 'comments.created_at', 'users.uuid', 'users.firstname', 'users.lastname', 'users.user_name')
                       ->orderBy('comments.created_at', 'desc')
                       ->get(); 
                       
        $total_comment = DB::table('comments')
                            ->where('post_id', $post_id)
                            ->count();  

                        //insert total comment    
                        DB::table('posts')
                            ->where('id', $post_id)
                            ->update(['total_comment' => $total_comment]);

        $current_user_id = Auth::user()->id;

        // Check if the user has already viewed the post
        $hasViewed = DB::table('posts')
            ->where('id',$post_id)
            ->where('viewed_by', $current_user_id)
            ->exists();

        if (!$hasViewed) {
            // Update view count and mark the post as viewed by the user
            DB::table('posts')
                ->where('id', $post_id)
                ->increment('view_count');

            DB::table('posts')
                ->where('id', $post_id)
                ->update(['viewed_by' => $current_user_id]);
            }       
        return view('single-post')
                    ->with('data', $data)
                    ->with('comment_data', $comment_data)
                    ->with('total_comment', $total_comment)
                    ->with('current_user_id', $current_user_id)
                    ->withSuccess('You have Successfully loggedin');
 
    }

    public function EditPost()
    {
        $uuid = request()->uuid;
        $data = DB::table('posts')
                      ->where('uuid', $uuid)
                      ->get(['description', 'uuid']);
        return view('edit-post')->with('data', $data);

    }  

    public function StoreEditPost()
    {
        $uuid = request()->uuid;
        $description = request()->barta;
        $data = DB::table('posts')
                    ->where('uuid', $uuid)
                    ->update([
                        'description' => $description
                    ]);

        echo "<h2>Your Post Updated Successfully</h2>";           
        ob_flush();
        flush();
        sleep(2); // Adjust the duration as needed
        return redirect('/');
    }

    public function DeletePost()
    {
        $uuid = request()->uuid;
        $data = DB::table('posts')
                ->where('uuid', $uuid)
                ->delete();
        return redirect('/');      
    }

}
