<?php
declare(strict_types=1);

namespace App\Http\Controllers\Actions\Smaregi;

use App\Http\Controllers\Controller;
use App\Http\Session\StateSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Smareco\Shared\Models\ValueObjects\ClientId;

class RedirectSmaregiUserAuthAction extends Controller
{
    /**
     * @var StateSession
     */
    private StateSession $stateSession;

    /**
     * RedirectSmaregiUserAuthAction constructor.
     *
     * @param StateSession $stateSession
     */
    public function __construct(StateSession $stateSession)
    {
        $this->stateSession = $stateSession;
    }

    /**
     * Handle the incoming request.
     *
     * @return RedirectResponse
     */
    public function __invoke()
    {
        $state = Str::uuid()->toString();
        $this->stateSession->setState($state);
        $params = [
            'response_type=code',
            'client_id=' . (string) (new ClientId(config('smareco.client_id'))),
            'scope=openid',
            'state=' . $state,
            'redirect_uri=' . route('openid'),
        ];
        return redirect()->away(url(config('smareco.smaregi_api_host.idp') . '/authorize?' . implode('&', $params)));
    }
}
