<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
class PermissionMiddleware
{
    protected $auth;

      public function __construct(Guard $auth) {
        $this->auth = $auth;
      }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission)
    {
        if(!$this->auth->user()->can($permission)) {
          return response('Unauthorized.', 401); //Or redirect() or whatever you want
         // return dd($this->auth); //Or redirect() or whatever you want
        }
        return $next($request);
    }
}
