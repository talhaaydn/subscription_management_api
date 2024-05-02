<?php

namespace App\Controller\Api;

use App\Dto\Request\VerifyRequestDto;
use App\Helper\ResponseHelper;
use App\Service\VerifyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('mock-api/verify')]
class MockController extends AbstractController
{
    #[Route('/google', name: 'verify_google', methods: ['POST'])]
    public function verifyGoogle(
        #[MapRequestPayload] VerifyRequestDto $verifyRequestDto,
        VerifyService $verifyService,
    ): JsonResponse
    {
        return ResponseHelper::generateResponse($verifyService->verify($verifyRequestDto));
    }

    #[Route('/ios', name: 'verify_ios', methods: ['POST'])]
    public function verifyIos(
        #[MapRequestPayload] VerifyRequestDto $verifyRequestDto,
        VerifyService $verifyService,
    ): JsonResponse
    {
        return ResponseHelper::generateResponse($verifyService->verify($verifyRequestDto));
    }
}
