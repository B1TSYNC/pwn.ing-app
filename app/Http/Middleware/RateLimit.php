<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\RateLimiter as FacadesRateLimiter;
use Illuminate\Support\InteractsWithTime;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Cache\RateLimiting\RateLimiter as RateLimitingRateLimiter;
use Illuminate\Cache\RateLimiting\Unlimited;


class ApiRateLimiter extends ThrottleRequests
{
    use InteractsWithTime;

    protected function resolveRequestSignature(Request $request)
    {
        if ($user = $request->user()) {
            return sha1($user->getAuthIdentifier());
        }

        if ($route = $request->route()) {
            return sha1($route->getDomain().'|'.$request->ip());
        }

        throw new RuntimeException('Listen buddy we were unable to generate the request signature. Now the Route is currently unavailable.');
    }

    protected function getRateLimiter(Request $request): RateLimiter
    {
        $config = config('api.rate_limiter');

        return FacadesRateLimiter::instance(
            $this->resolveRequestSignature($request),
            $config['decay_minutes'] * 60
        )->setLimit($config['max_requests']);
    }

    

    protected function handleRequest($request, Closure $next, $maxAttempts, $decaySeconds)
    {
        $limiter = $this->getRateLimiter($request);

        if ($limiter->tooManyAttempts()) {
            $retryAfter = $this->getTimeUntilNextRetry($request);

            return $this->buildException($request, $maxAttempts, $retryAfter);
        }

        $limiter->hit();

        $response = $next($request);

        return $this->addHeaders(
            $response,
            $maxAttempts,
            $limiter->attempts(),
            $limiter->availableIn($decaySeconds)
        );
    }

    protected function buildException(Request $request, $maxAttempts, $retryAfter)
    {
        $headers = [
            'Retry-After' => $retryAfter,
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => 0,
            'X-RateLimit-Reset' => $this->availableAt($retryAfter),
        ];

        throw ValidationException::withMessages([
            'errors' => 'Too many attempts, please try again later.',
        ])->status(Response::HTTP_TOO_MANY_REQUESTS)
          ->withHeaders($headers);
    }


}
