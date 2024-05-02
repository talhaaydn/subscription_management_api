<?php

namespace App\Service;

use App\Entity\Application;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApplicationService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CacheService $cacheService
    )
    {}

    public function getApplicationById(int $applicationId): Application
    {
        $cacheKey = "application-{$applicationId}";

        if ($application = $this->cacheService->get($cacheKey)) {
            return $application;
        }

        $application = $this->entityManager->getRepository(Application::class)->find($applicationId);

        if ($application === null) {
            throw new NotFoundHttpException('APPLICATION NOT FOUND');
        }

        $this->cacheService->set($application, $cacheKey);

        return $application;
    }
}