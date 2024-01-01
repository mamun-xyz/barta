<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ValidEditor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $user_uuid = $user->user_uuid;             
        
        $editor_uuid= request()->user_uuid;
                
        if(  $user_uuid ==  $editor_uuid )
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
