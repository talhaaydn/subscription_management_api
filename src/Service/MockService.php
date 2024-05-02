<?php

namespace App\Service;

use App\Dto\Response\VerifyResponseDto;
use App\Enum\OperatingSystemEnum;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MockService
{
    public function __construct(
        private readonly RouterInterface $router,
        private readonly HttpClientInterface $client,
        private readonly ParameterBagInterface $parameterBag,
    )
    {
    }

    public function createVerify(string $operatingSystem, string $receipt): VerifyResponseDto
    {
        switch ($operatingSystem) {
            case OperatingSystemEnum::IOS->value:
                return $this->requestForIos($receipt);

            case OperatingSystemEnum::GOOGLE->value:
                return $this->requestForGoogle($receipt);
        }

        throw new \InvalidArgumentException("INVALID OPERATING SYSTEM");
    }

    private function requestForGoogle(string $receipt): VerifyResponseDto
    {
        $uri = $this->router->generate('verify_google', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $response = $this->client->request(
            Request::METHOD_POST,
            $uri,
            [
                'headers' => [
                    "Authorization" => "Basic " . base64_encode("{$this->parameterBag->get('google_api_username')}:{$this->parameterBag->get('google_api_username')}")
                ],
                'json' => ['receipt' => $receipt]
            ]
        );

        $result = json_decode($response->getContent(), true);

        return (new VerifyResponseDto())
            ->setStatus($result['data']['status'])
            ->setExpireDate($result['data']['expireDate']);
    }

    private function requestForIos(string $receipt): VerifyResponseDto
    {
        $uri = $this->router->generate('verify_ios', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $response = $this->client->request(
            Request::METHOD_POST,
            $uri,
            [
                'headers' => [
                    "Authorization" => "Basic " . base64_encode("{$this->parameterBag->get('ios_api_username')}:{$this->parameterBag->get('ios_api_username')}")
                ],
                'json' => ['receipt' => $receipt]
            ]
        );

        $result = json_decode($response->getContent(), true);

        return (new VerifyResponseDto())
            ->setStatus($result['data']['status'])
            ->setExpireDate($result['data']['expireDate']);
    }
}