<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $requestData
     * @return string|null
     */
    protected function redirectTo($requestData)
    {
        if (! $requestData->expectsJson()) {
            return route('login');
        }
    }
}
