<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Session\SmaregiUserInfoSession;
use Closure;
use Illuminate\Http\Request;
use Smareco\Exceptions\UnauthorizedException;

class AuthMiddleware
{
    /**
     * @var SmaregiUserInfoSession
     */
    private SmaregiUserInfoSession $smaregiUserInfoSession;

    /**
     * AuthMiddleware constructor.
     *
     * @param SmaregiUserInfoSession $smaregiUserInfoSession
     */
    public function __construct(SmaregiUserInfoSession $smaregiUserInfoSession)
    {
        $this->smaregiUserInfoSession = $smaregiUserInfoSession;
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
        if (!$this->smaregiUserInfoSession->isLoggedIn()) {
            throw new UnauthorizedException('このアプリを使用するためにはスマレジのログイン情報が必要です。');
        }
        return $next($request);
    }
}
