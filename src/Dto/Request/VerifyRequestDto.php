<?php

namespace App\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

final class VerifyRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $receipt
    ) {
    }
}