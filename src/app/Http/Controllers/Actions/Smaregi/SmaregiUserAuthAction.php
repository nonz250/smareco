<?php
declare(strict_types=1);

namespace App\Http\Controllers\Actions\Smaregi;

use App\Adapters\SaveSmaregiUserInfo\SaveSmaregiUserInfoOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\Smaregi\SmaregiUserAuthRequest;
use App\Http\Session\StateSession;
use Illuminate\Http\RedirectResponse;
use Smareco\Exceptions\NotFoundException;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo\SaveSmaregiUserInfoInterface;
use Throwable;

class SmaregiUserAuthAction extends Controller
{
    /**
     * @var StateSession
     */
    private StateSession $stateSession;

    /**
     * @var SaveSmaregiUserInfoInterface
     */
    private SaveSmaregiUserInfoInterface $smaregiUserInfoUseCase;

    /**
     * SmaregiUserAuthAction constructor.
     *
     * @param StateSession $stateSession
     * @param SaveSmaregiUserInfoInterface $smaregiUserInfoUseCase
     */
    public function __construct(
        StateSession $stateSession,
        SaveSmaregiUserInfoInterface $smaregiUserInfoUseCase
    ) {
        $this->stateSession = $stateSession;
        $this->smaregiUserInfoUseCase = $smaregiUserInfoUseCase;
    }

    /**
     * Handle the incoming request.
     *
     * @param SmaregiUserAuthRequest $request
     * @throws SmarecoSpecificationExceptionInterface
     * @throws Throwable
     * @return RedirectResponse
     */
    public function __invoke(SmaregiUserAuthRequest $request)
    {
        if ($this->stateSession->state() !== $request->get('state', '')) {
            throw new NotFoundException('不正なアクセスです。');
        }

        $response = new SaveSmaregiUserInfoOutput();

        try {
            $this->smaregiUserInfoUseCase->process($request, $response);
        } catch (SmarecoSpecificationExceptionInterface $e) {
            throw $e;
        } catch (Throwable $e) {
            throw $e;
        }
        return redirect()->route('top');
    }
}
