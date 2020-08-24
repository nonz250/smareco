<?php
declare(strict_types=1);

namespace App\Http\Controllers\Actions;

use App\Adapters\SaveSmaregiUserInfo\DeleteSmaregiUserInfoOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\LogoutRequest;
use Illuminate\Http\RedirectResponse;
use Smareco\SmaregiUserInfo\Command\UseCases\DeleteSmaregiUserInfo\DeleteSmaregiUserInfoInterface;
use Throwable;

class LogoutAction extends Controller
{
    /**
     * @var DeleteSmaregiUserInfoInterface
     */
    private DeleteSmaregiUserInfoInterface $deleteSmaregiUserInfoUseCase;

    /**
     * LogoutAction constructor.
     *
     * @param DeleteSmaregiUserInfoInterface $deleteSmaregiUserInfoUseCase
     */
    public function __construct(DeleteSmaregiUserInfoInterface $deleteSmaregiUserInfoUseCase)
    {
        $this->deleteSmaregiUserInfoUseCase = $deleteSmaregiUserInfoUseCase;
    }

    /**
     * Handle the incoming request.
     *
     * @param LogoutRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(LogoutRequest $request)
    {
        $response = new DeleteSmaregiUserInfoOutput();
        try {
            $this->deleteSmaregiUserInfoUseCase->process($request, $response);
        } catch (Throwable $e) {
            throw $e;
        }
        return redirect()->route('top');
    }
}
