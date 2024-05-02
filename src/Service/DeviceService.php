<?php

namespace App\Service;

use App\Dto\Request\DeviceRegisterRequestDto;
use App\Dto\Response\DeviceRegisterResponseDto;
use App\Entity\Application;
use App\Entity\Device;
use App\Entity\Language;
use Doctrine\ORM\EntityManagerInterface;

class DeviceService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ApplicationService $applicationService,
        private readonly LanguageService $languageService,
        private readonly CacheService $cacheService,
        private readonly DeviceTokenService $deviceTokenService
    )
    {}

    public function register(DeviceRegisterRequestDto $deviceRegisterRequestDto): DeviceRegisterResponseDto
    {
        $application = $this->applicationService->getApplicationById($deviceRegisterRequestDto->appId);
        $language = $this->languageService->getLanguageById($deviceRegisterRequestDto->langId);

        $cacheKey = "app-{$application->getId()}-uid-{$deviceRegisterRequestDto->uid}";
        if ($clientToken = $this->cacheService->get($cacheKey)) {
            return (new DeviceRegisterResponseDto())
                ->setClientToken($clientToken);
        }

        $device = $this->createDevice($deviceRegisterRequestDto, $application, $language);
        $deviceToken = $this->deviceTokenService->getDeviceToken($device);

        $this->cacheService->set($deviceToken->getClientToken(), $cacheKey);

        return (new DeviceRegisterResponseDto())
            ->setClientToken($deviceToken->getClientToken());
    }

    private function createDevice(
        DeviceRegisterRequestDto $deviceRegisterRequestDto,
        Application $application,
        Language $language
    ): Device
    {
        $device = (new Device())
            ->setUid($deviceRegisterRequestDto->uid)
            ->setApplication($application)
            ->setLanguage($language)
            ->setOperatingSystem($deviceRegisterRequestDto->operatingSystem->value);

        $this->entityManager->persist($device);
        $this->entityManager->flush();

        return $device;
    }
}