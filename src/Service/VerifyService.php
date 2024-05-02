<?php

namespace App\Service;

use App\Dto\Request\VerifyRequestDto;
use App\Dto\Response\VerifyResponseDto;
use DateInterval;

class VerifyService
{
    public function verify(VerifyRequestDto $verifyRequestDto): VerifyResponseDto
    {
        $lastCharacter = intval(substr($verifyRequestDto->receipt, -1));

        if ($lastCharacter % 2 === 1) {
            $expireDate = new \DateTime('now', new \DateTimeZone('+6'));
            $expireDate->add(new DateInterval('P30D'));

            return (new VerifyResponseDto)
                ->setStatus(true)
                ->setExpireDate($expireDate->format('Y-m-d H:i:s'));
        }

        return (new VerifyResponseDto)
            ->setStatus(false);
    }
}