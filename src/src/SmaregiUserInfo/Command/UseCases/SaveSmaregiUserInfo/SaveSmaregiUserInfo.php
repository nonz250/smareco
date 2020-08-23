<?php
declare(strict_types=1);

namespace Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Repositories\SmaregiUserInfoRepositoryInterface;
use Smareco\Shared\Models\Repositories\SmaregiUserTokenRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\Code;
use Smareco\Shared\Models\ValueObjects\GrantType;
use Smareco\Shared\Models\ValueObjects\RedirectUri;

class SaveSmaregiUserInfo implements SaveSmaregiUserInfoInterface
{
    /**
     * @var SmaregiUserTokenRepositoryInterface
     */
    private SmaregiUserTokenRepositoryInterface $smaregiUserTokenRepository;

    /**
     * @var SmaregiUserInfoRepositoryInterface
     */
    private SmaregiUserInfoRepositoryInterface $smaregiUserInfoRepository;

    /**
     * SaveSmaregiUserInfo constructor.
     *
     * @param SmaregiUserTokenRepositoryInterface $smaregiUserTokenRepository
     * @param SmaregiUserInfoRepositoryInterface $smaregiUserInfoRepository
     */
    public function __construct(
        SmaregiUserTokenRepositoryInterface $smaregiUserTokenRepository,
        SmaregiUserInfoRepositoryInterface $smaregiUserInfoRepository
    ) {
        $this->smaregiUserTokenRepository = $smaregiUserTokenRepository;
        $this->smaregiUserInfoRepository = $smaregiUserInfoRepository;
    }

    /**
     * @param SaveSmaregiUserInfoInputPort $inputPort
     * @param SaveSmaregiUserInfoOutputPort $outputPort
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function process(SaveSmaregiUserInfoInputPort $inputPort, SaveSmaregiUserInfoOutputPort $outputPort): void
    {
        $tokenResponse = $this->smaregiUserTokenRepository->findFromApi(
            new GrantType($inputPort->grantType()),
            new Code($inputPort->code()),
            new RedirectUri($inputPort->redirectUri()),
        );
        $smaregiUseInfo = $this->smaregiUserInfoRepository->findUserInfoFromApi(
            $tokenResponse->tokenType(),
            $tokenResponse->accessToken()
        );
        $this->smaregiUserInfoRepository->saveUserInfoToSession($smaregiUseInfo);
        $outputPort->output($smaregiUseInfo);
    }
}
