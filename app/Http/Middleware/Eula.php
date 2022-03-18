<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class Eula
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
   
       if(Auth::check() && Session::get('eula') == 'accept'){
            return $next($request);
       }
           return redirect('eula'); 
        
     }
}
