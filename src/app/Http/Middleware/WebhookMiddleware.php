<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Smareco\Exceptions\NotFoundException;

class WebhookMiddleware
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
        $webhookKey = $request->header((string) config('smareco.webhook_header.key'), '') ?? '';
        $contractId = $request->header('smaregi-contract-id', '') ?? '';
        $event = $request->header('smaregi-event', '') ?? '';
        $webhooks = [];
        foreach (config('smareco.webhooks') as $key => $item) {
            $webhooks[] = $item;
        }

        if ($webhookKey !== (string) config('smareco.webhook_header.value')) {
            throw new NotFoundException('このページはありません。');
        }
        if (!$contractId) {
            throw new NotFoundException('ヘッダー値に契約IDは必須です。');
        }
        if (!$event) {
            throw new NotFoundException('ヘッダー値にイベント名は必須です。');
        }
        if (!in_array($event, $webhooks, true)) {
            throw new NotFoundException('登録されたイベントにないイベントです。');
        }
        return $next($request);
    }
}
