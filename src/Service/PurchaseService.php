<?php

namespace App\Service;

use App\Dto\Request\PurchaseRequestDto;
use App\Dto\Response\PurchaseResponseDto;
use App\Entity\Device;
use App\Type\ClientTokenUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PurchaseService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly SubscriptionService $subscriptionService,
        private readonly MockService $mockService,
    )
    {}

    public function purchase(PurchaseRequestDto $purchaseRequestDto, ClientTokenUser $clientTokenUser): PurchaseResponseDto
    {
        $device = $this->entityManager->getRepository(Device::class)->find($clientTokenUser->getDeviceId());

        if ($device === null) {
            throw new NotFoundHttpException('DEVICE NOT FOUND');
        }

        $response = $this->mockService->createVerify($clientTokenUser->getOperatingSystem(), $purchaseRequestDto->receipt);

        if (!$response->isStatus())
            return (new PurchaseResponseDto())->setStatus(false);

        $this->subscriptionService->create($device, $response->getExpireDate(), $purchaseRequestDto->receipt);

        return (new PurchaseResponseDto())->setStatus(true);
    }
}