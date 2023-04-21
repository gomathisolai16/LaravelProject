<?php

namespace App\Http\Middleware;

use Closure;
use \App\Models\User;
use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
use \Illuminate\Support\Facades\Hash;

class ApiLandingPageBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get username through Basic HTTP Auth 
        $username = $request->getUser();
        // Get password through Basic HTTP Auth 
        $password = $request->getPassword();
        // Check if user exists in database
        $user = User::where(['username' => $username])->first();
        if (!$user) {
            return $this->unauthorizedResponse('User not found');
        }
        $passwordMatch = Hash::check($password, $user->password);
        if (!$passwordMatch) {
            return $this->unauthorizedResponse('Wrong password');
        }
        if (!$user->hasRole('admin')) {
            return $this->unauthorizedResponse('User is not admin');
        }
        return $next($request);
    }

    /**
     * Handle unauthorized response for Basic HTTP Auth
     * 
     * @param string $realm
     * @return \Illuminate\Http\Response
     */
    protected function unauthorizedResponse($realm = "Access Denied")
    {
        return new Response('Unauthorized.', 401, ['WWW-Authenticate' => 'Basic realm="' . $realm . '"']);
    }
}
