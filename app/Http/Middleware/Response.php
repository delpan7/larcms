<?php

namespace App\Http\Middleware;

use Closure;
use Route;

class Response
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
        $route = str_replace(['App\\Http\\Controllers\\', 'Controller'], '', Route::currentRouteAction());
        
        list($module, $controller) = explode('\\', $route);
        list($controller, $action) = explode('@', $controller);
        $module = snake_case($module);
        $controller = snake_case($controller);
        $action = snake_case($action);
// dd($module, $controller, $action, $response);
        $tpl_path = $module . ',' . $controller . ',' . $action;

        // return view($tpl_path, $response['data']);
    }
}
