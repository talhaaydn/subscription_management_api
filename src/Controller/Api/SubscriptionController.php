<?php

namespace App\Controller\Api;

use App\Dto\Request\PurchaseRequestDto;
use App\Helper\ResponseHelper;
use App\Service\PurchaseService;
use App\Service\SubscriptionService;
use App\Type\ClientTokenUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('api/subscription')]
class SubscriptionController extends AbstractController
{
    #[Route('/purchase', name: 'subscription_purchase', methods: ['POST'])]
    public function purchase(
        #[MapRequestPayload] PurchaseRequestDto $purchaseRequestDto,
        #[CurrentUser] ClientTokenUser $clientTokenUser,
        PurchaseService $purchaseService,
    ): JsonResponse
    {
        return ResponseHelper::generateResponse($purchaseService->purchase($purchaseRequestDto, $clientTokenUser));
    }

    #[Route('/check', name: 'subscription_check', methods: ['POST'])]
    public function check(
        #[CurrentUser] ClientTokenUser $clientTokenUser,
        SubscriptionService $purchaseService,
    ): JsonResponse
    {
        return ResponseHelper::generateResponse($purchaseService->checkSubscription($clientTokenUser));
    }
}
