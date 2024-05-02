<?php

namespace App\Service;

use App\Entity\Language;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LanguageService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CacheService $cacheService
    )
    {}

    public function getLanguageById(int $languageId): Language
    {
        $cacheKey = "language-{$languageId}";

        if ($language = $this->cacheService->get($cacheKey)) {
            return $language;
        }

        $language = $this->entityManager->getRepository(Language::class)->find($languageId);

        if ($language === null) {
            throw new NotFoundHttpException('LANGUAGE NOT FOUND');
        }

        $this->cacheService->set($language, $cacheKey);

        return $language;
    }
}