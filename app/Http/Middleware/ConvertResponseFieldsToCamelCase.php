<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertResponseFieldsToCamelCase
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
        $response = $next($request);
        $content = $response->getContent();

        try {
            $json = json_decode($content, true);
            $response->setContent(json_encode(
                convertArrayAttributes($json)
            ));
        } catch (\Exception $e) {
            // you can log an error here if you want
        }

        return $response;
    }
}
