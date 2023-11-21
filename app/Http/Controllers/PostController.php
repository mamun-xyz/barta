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
                    ->select('posts.description', 'posts.view_count', 'posts.uuid', 'users.firstname', 'users.lastname', 'users.user_name', DB::raw('CAST(posts.updated_at AS datetime) as updated_at'))
                    ->where('posts.uuid', $uuid)
                    ->orderBy('posts.created_at', 'desc')
                    ->get();  

        return view('single-post')->with('data', $data)
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
