<?php

namespace App\EventListener;

use App\Entity\Subscription;
use App\Enum\SubscriptionStatusEnum;
use App\Service\CallbackService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Subscription::class)]
#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Subscription::class)]
class SubscriberListener
{
    public function __construct(private readonly CallbackService $callbackService)
    {
    }

    public function preUpdate(Subscription $subscription, PreUpdateEventArgs $event): void
    {
        if (array_key_exists('state', $event->getEntityChangeSet())) {
            if (in_array($event->getNewValue('state'), [SubscriptionStatusEnum::CANCELED->value, SubscriptionStatusEnum::RENEWED->value])) {
                $this->callbackService->callbackRequest($subscription, $event->getNewValue('state'));
            }
        }

    }

    public function postPersist(Subscription $subscription, PostPersistEventArgs $event): void
    {
        $this->callbackService->callbackRequest($subscription, SubscriptionStatusEnum::STARTED->value);
    }
}