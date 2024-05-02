<?php

namespace App\Dto\Response;

class CheckSubscriptionResponseDto
{
    private bool $status;
    private ?string $startedAt = null;
    private ?string $expireDate = null;

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): CheckSubscriptionResponseDto
    {
        $this->status = $status;
        return $this;
    }

    public function getStartedAt(): ?string
    {
        return $this->startedAt;
    }

    public function setStartedAt(?string $startedAt): CheckSubscriptionResponseDto
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    public function getExpireDate(): ?string
    {
        return $this->expireDate;
    }

    public function setExpireDate(?string $expireDate): CheckSubscriptionResponseDto
    {
        $this->expireDate = $expireDate;
        return $this;
    }
}