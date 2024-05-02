<?php

namespace App\Service;

use App\Entity\Device;
use App\Entity\DeviceToken;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DeviceTokenService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ParameterBagInterface $parameterBag
    )
    {}

    public function getDeviceToken(Device $device): DeviceToken
    {
        $deviceToken = $this->entityManager->getRepository(DeviceToken::class)->findOneBy(['device' => $device]);

        if ($deviceToken)
            return $deviceToken;

        return $this->createDeviceToken($device);
    }

    public function createDeviceToken(Device $device): DeviceToken
    {
        $deviceToken = (new DeviceToken())
            ->setDevice($device)
            ->setClientToken($this->generateClientToken($device));

        $this->entityManager->persist($deviceToken);
        $this->entityManager->flush();

        return $deviceToken;
    }

    private function generateClientToken(Device $device): string
    {
        $data = [
            'applicationId' => $device->getApplication()->getId(),
            'operatingSystem' => $device->getOperatingSystem(),
            'deviceId' => $device->getId()
        ];

        return JWT::encode($data, $this->parameterBag->get('auth_secret'), 'HS256');
    }

}