<?php

namespace App\Service;

use App\Entity\Subscription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallbackService
{
    public function __construct(
        private readonly HttpClientInterface $client,
    )
    {
    }

    public function callbackRequest(Subscription $subscription, string $event): void
    {
        $device = $subscription->getDevice();
        $application = $device->getApplication();

        $this->client->request(
            Request::METHOD_POST,
            $application->getCallbackUrl(),
            [
                'json' => [
                    'appId' => $application->getId(),
                    'deviceId' => $device->getId(),
                    'event' => $event,
                ]
            ]
        );
    }
}