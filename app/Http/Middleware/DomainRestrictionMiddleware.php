<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DomainRestrictionMiddleware
{
    /**
     * List domain yang diperbolehkan.
     */
    private array $allowedDomains = [
        'https://example.com',
        'https://sub.example.com',
        'http://localhost:5173',
        'http://localhost:8000' // Untuk pengembangan lokal
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $origin = $request->header('Origin');

        if ($origin === null || in_array($origin, $this->allowedDomains)) {
            return $next($request);
        }

        if (!in_array($origin, $this->allowedDomains)) {
            return response()->json([
                'success' => false,
                'message' => 'Access Denied. Your domain is not allowed.'
            ], 403);
        }

        return $next($request);
    }
}
