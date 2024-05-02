<?php

namespace App\Dto\Response;

class PurchaseResponseDto
{
    private bool $status;

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): PurchaseResponseDto
    {
        $this->status = $status;
        return $this;
    }
}