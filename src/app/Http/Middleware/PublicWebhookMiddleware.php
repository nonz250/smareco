<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Smareco\Exceptions\NotFoundException;

class PublicWebhookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @throws NotFoundException
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $headerKey = (string) config('smareco.webhook_header.key', '');
        $webhookKey = $request->header($headerKey) ?? $request->get($headerKey) ?? '';
        if ($webhookKey !== (string) config('smareco.webhook_header.value', '')) {
            throw new NotFoundException('このページはありません。');
        }
        return $next($request);
    }
}
