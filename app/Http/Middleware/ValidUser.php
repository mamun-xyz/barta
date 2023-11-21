<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use DB;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $userUuid = $user->uuid;
        $user_table_id = DB::table('users')
                             ->where('uuid',  $userUuid)
                             ->value('id');             
   
        $uuid = request()->uuid;
        $post_table_user_id = DB::table('posts')
                                  ->where('uuid',  $uuid)
                                  ->value('user_id');                

        if( $user_table_id == $post_table_user_id )
        {
            return $next($request);
          
        } else
        {
            echo "<h2>" . "You are not permitted." . "</h2>";
            ob_flush();
            flush();
            sleep(2); 
            return redirect('/');
        }
        
    }
}
