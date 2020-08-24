<?php
declare(strict_types=1);

namespace Smareco\SmaregiUserInfo\Command\UseCases\GetSmaregiUserInfo;

use Smareco\Shared\Models\Repositories\SmaregiUserInfoRepositoryInterface;

class GetSmaregiUserInfo implements GetSmaregiUserInfoInterface
{
    /**
     * @var SmaregiUserInfoRepositoryInterface
     */
    private SmaregiUserInfoRepositoryInterface $smaregiUserInfoRepository;

    /**
     * GetSmaregiUserInfo constructor.
     *
     * @param SmaregiUserInfoRepositoryInterface $smaregiUserInfoRepository
     */
    public function __construct(SmaregiUserInfoRepositoryInterface $smaregiUserInfoRepository)
    {
        $this->smaregiUserInfoRepository = $smaregiUserInfoRepository;
    }

    /**
     * @param GetSmaregiUserInfoInputPort $inputPort
     * @param GetSmaregiUserInfoOutputPort $outputPort
     */
    public function process(GetSmaregiUserInfoInputPort $inputPort, GetSmaregiUserInfoOutputPort $outputPort): void
    {
        $smaregiUserInfo = $this->smaregiUserInfoRepository->findUserInfoFromSession();
        $outputPort->output($smaregiUserInfo);
    }
}
