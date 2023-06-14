<?php

namespace App\Http\Middleware;

use Closure;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SanitizeHtml
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, array $htmlInputs = []): Response
    {
        $data = $request->all();
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        
        if (count($htmlInputs) > 0) {
            foreach ($data as $key => &$value) {
                if (in_array($key, $htmlInputs) && is_string($value)) {
                    $value = $purifier->purify($value);
                }
            }
        }
        
        $request->merge($data);
        return $next($request);
    }
}
