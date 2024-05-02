<?php

namespace App\Dto\Response;

class DeviceRegisterResponseDto
{
    private string $clientToken;

    public function getClientToken(): string
    {
        return $this->clientToken;
    }

    public function setClientToken(string $clientToken): DeviceRegisterResponseDto
    {
        $this->clientToken = $clientToken;
        return $this;
    }
}