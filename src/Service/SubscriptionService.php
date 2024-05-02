<?php

namespace App\Service;

use App\Dto\Response\CheckSubscriptionResponseDto;
use App\Entity\Device;
use App\Entity\Subscription;
use App\Enum\SubscriptionStatusEnum;
use App\Type\ClientTokenUser;
use Doctrine\ORM\EntityManagerInterface;

class SubscriptionService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {}

    public function create(Device $device, string $expireDate, string $receipt): void
    {
        $subscription = (new Subscription())
            ->setDevice($device)
            ->setState(SubscriptionStatusEnum::STARTED->value)
            ->setReceipt($receipt)
            ->setStartedAt(new \DateTime())
            ->setExpiredAt(new \DateTime($expireDate));

        $this->entityManager->persist($subscription);
        $this->entityManager->flush();
    }

    public function renewSubscription(Subscription $subscription): void
    {
        $subscription->setState(SubscriptionStatusEnum::RENEWED->value);
        $this->entityManager->flush();
    }

    public function cancelSubscription(Subscription $subscription): void
    {
        $subscription->setState(SubscriptionStatusEnum::CANCELED->value);
        $this->entityManager->flush();
    }

    public function checkSubscription(ClientTokenUser $clientTokenUser): CheckSubscriptionResponseDto
    {
        $subscription = $this->entityManager->getRepository(Subscription::class)->findOneBy(['device' => $clientTokenUser->getDeviceId()]);

        if (is_null($subscription)) {
            return (new CheckSubscriptionResponseDto())
                ->setStatus(false);
        }

        return (new CheckSubscriptionResponseDto())
            ->setStatus(true)
            ->setStartedAt($subscription->getStartedAt()->format('Y-m-d H:i:s'))
            ->setExpireDate($subscription->getExpiredAt()->format('Y-m-d H:i:s'));
    }
}