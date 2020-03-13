<?php

namespace App\Http\Middleware;

use App\Services\Utility\MyLogger2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Closure;

class MySecurityMiddleware
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
      $path = $request->path();
      MyLogger2::info("Entering My Security Middleware is handel() at path: " . $path);
      
      $secureCheck = true;
      if($request->is('/') ||
      $request->is('login') ||
      $request->is('register'))          
      {
      $secureCheck = false;
      }
      MyLogger2::info($secureCheck ? "Entering My security Middleware in handle() security required" :  "Entering My security Middleware in handle() no security require");
      
      $enable = true;
      if($enable && $secureCheck && session()->get('users_id') == null)
      {
          MyLogger2::info("Leaving my security middleware in handle() doing a redirect back to login()");
          Auth::logout();
          return redirect('/login');
      }
      return $next($request);
    }
}
