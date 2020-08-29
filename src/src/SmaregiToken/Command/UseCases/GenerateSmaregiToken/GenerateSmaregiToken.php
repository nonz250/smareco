<?php
declare(strict_types=1);

namespace Smareco\SmaregiToken\Command\UseCases\GenerateSmaregiToken;

use Smareco\Shared\Models\Collection\ScopeCollection;
use Smareco\Shared\Models\Repositories\SmaregiTokenRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\GrantType;

class GenerateSmaregiToken implements GenerateSmaregiTokenInterface
{
    /**
     * @var SmaregiTokenRepositoryInterface
     */
    private SmaregiTokenRepositoryInterface $smaregiTokenRepository;

    /**
     * GenerateSmaregiToken constructor.
     *
     * @param SmaregiTokenRepositoryInterface $smaregiTokenRepository
     */
    public function __construct(SmaregiTokenRepositoryInterface $smaregiTokenRepository)
    {
        $this->smaregiTokenRepository = $smaregiTokenRepository;
    }

    public function process(GenerateSmaregiTokenInputPort $inputPort, GenerateSmaregiTokenOutputPort $outputPort): void
    {
        $tokenResponse = $this->smaregiTokenRepository->findToken(
            new GrantType($inputPort->grantType()),
            ScopeCollection::fromArray($inputPort->scopes()),
            $inputPort->contractId()
        );

        $tokenResponse = $this->smaregiTokenRepository->saveSmaregiTokenToSession($tokenResponse);

        $outputPort->output($tokenResponse);
    }
}
