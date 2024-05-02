<?php

namespace App\Type;

use Symfony\Component\Security\Core\User\UserInterface;

class ClientTokenUser implements UserInterface
{
    private int $applicationId;
    private int $deviceId;
    private string $clientToken;
    private string $operatingSystem;

    public function getApplicationId(): int
    {
        return $this->applicationId;
    }

    public function setApplicationId(int $applicationId): ClientTokenUser
    {
        $this->applicationId = $applicationId;
        return $this;
    }

    public function getDeviceId(): int
    {
        return $this->deviceId;
    }

    public function setDeviceId(int $deviceId): ClientTokenUser
    {
        $this->deviceId = $deviceId;
        return $this;
    }

    public function getClientToken(): string
    {
        return $this->clientToken;
    }

    public function setClientToken(string $clientToken): ClientTokenUser
    {
        $this->clientToken = $clientToken;
        return $this;
    }

    public function getOperatingSystem(): string
    {
        return $this->operatingSystem;
    }

    public function setOperatingSystem(string $operatingSystem): ClientTokenUser
    {
        $this->operatingSystem = $operatingSystem;
        return $this;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->clientToken;
    }
}