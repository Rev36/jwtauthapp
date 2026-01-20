<?php

namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
 
class RateLimitMiddleware
{
    protected $limiter;
 
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }
 
    public function handle($request, Closure $next, $maxAttempts = 3, $decayMinutes = 1)
    {
        if ($this->limiter->tooManyAttempts($this->throttleKey($request), $maxAttempts, $decayMinutes)) {
            return $this->buildRateLimitedResponse($decayMinutes);
        }
 
        $this->limiter->hit($this->throttleKey($request), $decayMinutes);
 
        $response = $next($request);
 
        return $this->addHeaders(
            $response,
            $maxAttempts,
            $this->calculateRemainingAttempts($request, $maxAttempts)
        );
    }
 
    protected function throttleKey($request)
    {
        return $request->fingerprint();
    }
 
    protected function buildRateLimitedResponse($seconds)
    {
        return response('Too Many Attempts.', 429)
            ->header('Retry-After', $seconds * 60);
    }
 
    protected function addHeaders($response, $maxAttempts, $remainingAttempts)
    {
        $response->headers->add([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $remainingAttempts,
        ]);
 
        return $response;
    }
 
    protected function calculateRemainingAttempts($request, $maxAttempts)
    {
        return $this->limiter->retriesLeft($this->throttleKey($request), $maxAttempts);
    }
}
 
