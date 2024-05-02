<?php

namespace App\Controller\Api;

use App\Dto\Request\DeviceRegisterRequestDto;
use App\Helper\ResponseHelper;
use App\Service\DeviceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/device')]
class DeviceController extends AbstractController
{
    #[Route('/register', name: 'device_register', methods: ['POST'])]
    public function register(
        #[MapRequestPayload] DeviceRegisterRequestDto $deviceRegisterRequestDto,
        DeviceService $deviceService,
    ): JsonResponse
    {
        return ResponseHelper::generateResponse($deviceService->register($deviceRegisterRequestDto));
    }
}
