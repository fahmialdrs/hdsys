<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
class verifyUserMiddleware
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
    public function handle($request, Closure $next)
    {
        if(!$this->auth->user()->hasRole('superAdmin') || !$this->auth->user()->hasRole('admin')) {
            if($this->auth->user()->id != $request->route('id')) {
              return response('Unauthorized.', 401); 
             
            }
        }
        return $next($request);
    }
}
