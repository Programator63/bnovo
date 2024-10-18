<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugHeaders
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
        $response = $next($request);

        // Добавляем заголовки
        $response->header('X-Debug-Time', microtime(true) - LARAVEL_START);
        $response->header('X-Debug-Memory', memory_get_usage() / 1024);

        return $response;
    }
}
