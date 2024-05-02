<?php

namespace App\Helper;

use App\Dto\Response\ApiResponseDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseHelper
{
    public static function generateResponse(
        object $data,
        ?string $message = "OK",
        ?int $statusCode = Response::HTTP_OK
    ): JsonResponse
    {
        $apiResponse = (new ApiResponseDto())
            ->setData($data)
            ->setMessage($message);

        $serializer = new Serializer(
            [new ObjectNormalizer()],
            [new JsonEncoder()]
        );

        $response = $serializer->serialize($apiResponse, 'json');

        return new JsonResponse($response, $statusCode, [], true);
    }
}