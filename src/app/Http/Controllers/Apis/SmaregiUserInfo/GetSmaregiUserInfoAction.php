<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\SmaregiUserInfo;

use App\Adapters\SaveSmaregiUserInfo\GetSmaregiUserInfoOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\SmaregiUserInfo\GetSmaregiUserInfoRequest;
use Illuminate\Http\JsonResponse;
use Smareco\SmaregiUserInfo\Command\UseCases\GetSmaregiUserInfo\GetSmaregiUserInfoInterface;
use Throwable;

class GetSmaregiUserInfoAction extends Controller
{
    /**
     * @var GetSmaregiUserInfoInterface
     */
    private GetSmaregiUserInfoInterface $getSmaregiUserInfoUseCase;

    /**
     * GetSmaregiUserInfoAction constructor.
     *
     * @param GetSmaregiUserInfoInterface $getSmaregiUserInfoUseCase
     */
    public function __construct(GetSmaregiUserInfoInterface $getSmaregiUserInfoUseCase)
    {
        $this->getSmaregiUserInfoUseCase = $getSmaregiUserInfoUseCase;
    }

    /**
     * Handle the incoming request.
     *
     * @param GetSmaregiUserInfoRequest $request
     * @throws Throwable
     * @return JsonResponse
     */
    public function __invoke(GetSmaregiUserInfoRequest $request)
    {
        $response = new GetSmaregiUserInfoOutput();
        try {
            $this->getSmaregiUserInfoUseCase->process($request, $response);
        } catch (Throwable $e) {
            throw $e;
        }
        return response()->json($response->smaregiUserInfo()->toArray());
    }
}
