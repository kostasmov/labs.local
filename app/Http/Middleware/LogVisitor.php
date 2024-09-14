<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class LogVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        Visitor::create([
            'visited_at' => now(),
            'page_url'   => $request->fullUrl(),
            'ip_address' => $request->ip(),
            'host_name'  => gethostbyaddr($request->ip()),
            'browser'    => $request->header('User-Agent'),
        ]);

        return $next($request);
    }
}
