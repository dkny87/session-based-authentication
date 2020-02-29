<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidSessionTokenException;
use App\Services\SessionService;
use Closure;
use Illuminate\Http\Request;

/**
 * Class Session
 * @package App\Http\Middleware
 */
class Session
{
    /**
     * @var SessionService
     */
    private $sessionService;

    /**
     * Session constructor.
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws InvalidSessionTokenException
     */
    public function handle($request, Closure $next)
    {
        $sessionId = $request->header('x-http-token');

        if (empty($sessionId)) {
            throw new InvalidSessionTokenException();
        }

        $session = $this->sessionService->findWhere(['session_id' => $sessionId]);

        if (!$session) {
            throw new InvalidSessionTokenException();
        }

        return $next($request);
    }
}
