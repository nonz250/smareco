<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Session\LoginSession;
use Closure;
use Illuminate\Http\Request;
use Smareco\Exceptions\UnauthorizedException;

class AuthMiddleware
{
    /**
     * @var LoginSession
     */
    private LoginSession $loginSession;

    /**
     * AuthMiddleware constructor.
     *
     * @param LoginSession $loginSession
     */
    public function __construct(LoginSession $loginSession)
    {
        $this->loginSession = $loginSession;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @throws UnauthorizedException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->loginSession->isLoggedIn()) {
            throw new UnauthorizedException('このアプリを使用するためにはスマレジのログイン情報が必要です。');
        }
        return $next($request);
    }
}
