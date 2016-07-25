<?php

namespace App\Http\Middleware;

use Closure;

use  Zizaco\Entrust\Entrust;
use Illuminate\Contracts\Auth\Guard;

class RoleMiddleware
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
    public function handle($request, Closure $next,$role)
    {
       // dd($this->auth);
        if(!$this->auth->user()->hasRole($role)) {
          return response('Unauthorized.', 401); //Or redirect() or whatever you want
         // return dd($this->auth); //Or redirect() or whatever you want
        }
        return $next($request);
    }
}
