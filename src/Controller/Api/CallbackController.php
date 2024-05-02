<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/callback')]
class CallbackController extends AbstractController
{
    #[Route('', name: 'callback', methods: ['POST'])]
    public function callback(
        Request $request
    ): JsonResponse
    {
        return $this->json($request->getContent());
    }
}
