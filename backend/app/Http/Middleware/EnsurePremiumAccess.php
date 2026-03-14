<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePremiumAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, ['premium', 'admin'])) {
            return response()->json([
                'message' => 'Premium access required.',
            ], 403);
        }

        return $next($request);
    }
}
