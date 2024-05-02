<?php

namespace App\Dto\Response;

class VerifyResponseDto
{
    private bool $status;
    private ?string $expireDate = null;

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): VerifyResponseDto
    {
        $this->status = $status;
        return $this;
    }

    public function getExpireDate(): ?string
    {
        return $this->expireDate;
    }

    public function setExpireDate(?string $expireDate): VerifyResponseDto
    {
        $this->expireDate = $expireDate;
        return $this;
    }
}