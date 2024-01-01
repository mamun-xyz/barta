<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function StorePost(Request $request, $user_uuid)
    {
        $user_id = User::where('user_uuid', '=', $user_uuid)
                       ->value('id');

        $post_uuid = Uuid::uuid4()->toString();

        if($request->file('picture'))
        {
            $path = Storage::putFile('public/post_photos', $request->file('picture'));
            $image_name = str_replace('public/post_photos/', '', $path);

            Post::create([
                'user_id' => $user_id,
                'post_uuid' => $post_uuid,
                'description' => implode($request->all('barta')),
                'image' => $image_name,
            ]);
        }else
        {
            Post::create([
                'user_id' => $user_id,
                'post_uuid' => $post_uuid,
                'description' => implode($request->all('barta')),
            ]);
        }

        echo "<h2>Successfully You Post</h2>";           
        ob_flush();
        flush();
        sleep(1); 
        return redirect('/');
    }
    
    public function SinglePost()
    {
        $post_uuid = request()->post_uuid;
        $data =  Post::with('user')
                     ->where('posts.post_uuid', $post_uuid)
                     ->orderBy('posts.created_at', 'desc')
                     ->get();                     

        $post_id =Post::where('post_uuid', $post_uuid)->value('id');
        
        $comment_data = Comment::with('user')
                                ->where('post_id', $post_id)
                                ->orderBy('comments.created_at', 'desc')
                                ->get(); 
                       
        $total_comment = Comment::where('post_id', $post_id)
                            ->count();  

                        //insert total comment    
                        Post::where('id', $post_id)
                            ->update(['total_comment' => $total_comment]);

        $current_user_id = Auth::user()->id;

        // Check if the user has already viewed the post
        $hasViewed = Post::where('id',$post_id)
                          ->where('viewed_by', $current_user_id)
                          ->exists();

        if (!$hasViewed) {
            // Update view count and mark the post as viewed by the user
            Post::where('id', $post_id)
                 ->increment('view_count');

            Post::where('id', $post_id)
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
        $post_uuid = request()->post_uuid;

        $data = Post::with('user')
                    ->where('post_uuid', $post_uuid)
                    ->get();

        return view('edit-post')->with('data', $data);

    }  

    public function StoreEditPost(Request $request)
    {
        $post_uuid = request()->post_uuid;
        $description = request()->barta;

        $old_image = Post::where('post_uuid', $post_uuid)->value('image'); 
         

        if( $new_image = $request->file('picture') )
        {
            Storage::delete('public/post_photos/' . $old_image);

            $path = Storage::putFile('public/post_photos', $new_image);
            $image_name = str_replace('public/post_photos/', '', $path);
        }else
        {
            $image_name = $old_image;
        }
        
        Post::where('post_uuid', $post_uuid)
                    ->update([
                    'description' => $description,
                    'image' => $image_name,
                ]);

        echo "<h2>Your Post Updated Successfully</h2>";           
        ob_flush();
        flush();
        sleep(2); // Adjust the duration as needed
        return redirect('/');
    }

    public function DeletePost()
    {
        $post_uuid = request()->post_uuid;

        $image = Post::where('post_uuid', $post_uuid)->value('image');

        Storage::delete('public/post_photos/' . $image);

        Post::where('post_uuid', $post_uuid)
                     ->delete();

        return redirect('/');      
    }

}
