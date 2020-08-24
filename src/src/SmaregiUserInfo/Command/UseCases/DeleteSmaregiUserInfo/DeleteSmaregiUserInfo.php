<?php
declare(strict_types=1);

namespace Smareco\SmaregiUserInfo\Command\UseCases\DeleteSmaregiUserInfo;

use Smareco\Shared\Models\Repositories\SmaregiUserInfoRepositoryInterface;

class DeleteSmaregiUserInfo implements DeleteSmaregiUserInfoInterface
{
    /**
     * @var SmaregiUserInfoRepositoryInterface
     */
    private SmaregiUserInfoRepositoryInterface $smaregiUserInfoRepository;

    /**
     * DeleteSmaregiUserInfo constructor.
     *
     * @param SmaregiUserInfoRepositoryInterface $smaregiUserInfoRepository
     */
    public function __construct(SmaregiUserInfoRepositoryInterface $smaregiUserInfoRepository)
    {
        $this->smaregiUserInfoRepository = $smaregiUserInfoRepository;
    }


    /**
     * @param DeleteSmaregiUserInfoInputPort $inputPort
     * @param DeleteSmaregiUserInfoOutputPort $outputPort
     */
    public function process(
        DeleteSmaregiUserInfoInputPort $inputPort,
        DeleteSmaregiUserInfoOutputPort $outputPort
    ): void {
        $this->smaregiUserInfoRepository->deleteUserInfoFromSession();
    }
}
