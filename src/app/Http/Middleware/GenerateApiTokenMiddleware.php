<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Adapters\SmaregiToken\GenerateSmaregiTokenInput;
use App\Adapters\SmaregiToken\GenerateSmaregiTokenOutput;
use App\Http\Session\SmaregiUserInfoSession;
use Closure;
use Illuminate\Http\Request;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\SmaregiToken\Command\UseCases\GenerateSmaregiToken\GenerateSmaregiTokenInterface;

class GenerateApiTokenMiddleware
{
    /**
     * @var GenerateSmaregiTokenInterface
     */
    private GenerateSmaregiTokenInterface $generateSmaregiTokenUseCase;

    /**
     * @var SmaregiUserInfoSession
     */
    private SmaregiUserInfoSession $smaregiUserInfoSession;

    /**
     * GenerateApiTokenMiddleware constructor.
     *
     * @param GenerateSmaregiTokenInterface $generateSmaregiTokenUseCase
     * @param SmaregiUserInfoSession $smaregiUserInfoSession
     */
    public function __construct(
        GenerateSmaregiTokenInterface $generateSmaregiTokenUseCase,
        SmaregiUserInfoSession $smaregiUserInfoSession
    ) {
        $this->generateSmaregiTokenUseCase = $generateSmaregiTokenUseCase;
        $this->smaregiUserInfoSession = $smaregiUserInfoSession;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @throws SmarecoSpecificationExceptionInterface
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $input = new GenerateSmaregiTokenInput($this->smaregiUserInfoSession);
        $output = new GenerateSmaregiTokenOutput();
        try {
            $this->generateSmaregiTokenUseCase->process($input, $output);
        } catch (SmarecoSpecificationExceptionInterface $e) {
            throw $e;
        }
        return $next($request);
    }
}
