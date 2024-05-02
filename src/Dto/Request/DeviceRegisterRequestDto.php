<?php

namespace App\Dto\Request;

use App\Enum\OperatingSystemEnum;
use Symfony\Component\Validator\Constraints as Assert;

final class DeviceRegisterRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $uid,

        #[Assert\NotBlank]
        public readonly int $appId,

        #[Assert\NotBlank]
        public readonly int $langId,

        #[Assert\NotBlank]
        #[Assert\Choice(callback: [OperatingSystemEnum::class, 'values'])]
        public readonly OperatingSystemEnum $operatingSystem,
    ) {
    }
}