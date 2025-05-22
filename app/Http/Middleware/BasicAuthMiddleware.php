<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $AUTH_USER = env('API_USER', 'user');
        $AUTH_PASS = env('API_PASS', 'password');

        header('Cache-Control: no-cache, must-revalidate, max-age=0');

        $has_supplied_credentials = $request->getUser() && $request->getPassword();

        $is_not_authenticated = (
            !$has_supplied_credentials ||
            $request->getUser() != $AUTH_USER ||
            $request->getPassword() != $AUTH_PASS
        );

        if ($is_not_authenticated) {
            $headers = ['WWW-Authenticate' => 'Basic realm="My Realm"'];
            return response('Unauthorized', 401, $headers);
        }

        return $next($request);
    }
}
