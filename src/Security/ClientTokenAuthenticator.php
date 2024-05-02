<?php

namespace App\Security;

use App\Type\ClientTokenUser;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class ClientTokenAuthenticator extends AbstractAuthenticator
{
    const KEY_NAME = 'Client-Token';

    public function __construct(
        private readonly ParameterBagInterface $bag,
    ) {}

    /**
     * @param Request $request
     * @return bool|null
     */
    public function supports(Request $request): ?bool
    {
        return $request->headers->has(self::KEY_NAME);
    }

    /**
     * @param Request $request
     * @return SelfValidatingPassport
     */
    public function authenticate(Request $request): SelfValidatingPassport
    {
        $clientToken = $request->headers->get(self::KEY_NAME);

        if (is_null($clientToken)) {
            throw new CustomUserMessageAuthenticationException('NO CLIENT TOKEN FOUND');
        }

        try {
            $clientTokenData = JWT::decode($clientToken, new Key($this->bag->get('auth_secret'), 'HS256'));
        } catch (\Exception $e) {
            throw new CustomUserMessageAuthenticationException($e->getMessage());
        }

        return new SelfValidatingPassport(
            new UserBadge($clientToken, function () use ($clientToken, $clientTokenData) {
                return (new ClientTokenUser())
                    ->setApplicationId($clientTokenData->applicationId)
                    ->setDeviceId($clientTokenData->deviceId)
                    ->setClientToken($clientToken)
                    ->setOperatingSystem($clientTokenData->operatingSystem);
            })
        );
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}