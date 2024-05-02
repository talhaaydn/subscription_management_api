<?php

namespace App\Entity;

use App\Entity\Trait\Timestamp;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity]
#[HasLifecycleCallbacks]
class DeviceToken
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(Device::class, cascade: ["persist"])]
    private Device $device;

    #[ORM\Column(type: 'string', length: 255)]
    private string $clientToken;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDevice(): Device
    {
        return $this->device;
    }

    public function setDevice(Device $device): DeviceToken
    {
        $this->device = $device;
        return $this;
    }

    public function getClientToken(): string
    {
        return $this->clientToken;
    }

    public function setClientToken(string $clientToken): DeviceToken
    {
        $this->clientToken = $clientToken;
        return $this;
    }
}
