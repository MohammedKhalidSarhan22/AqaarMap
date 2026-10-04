<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBrokerOrAgency
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && in_array($request->user()->role, ['broker', 'agency'])) {
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'غير مصرح لك. هذه العملية مخصصة للمكاتب العقارية والسماسرة فقط.'
        ], 403);
    }
    
    }
