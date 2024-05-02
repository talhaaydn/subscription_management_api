<?php

namespace App\Entity;

use App\Entity\Trait\Timestamp;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity]
#[HasLifecycleCallbacks]
class Subscription
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string', length: 20)]
    private string $state;

    #[ORM\Column(type: 'string', length: 255)]
    private string $receipt;

    #[ORM\ManyToOne(Device::class, cascade: ["persist"])]
    private Device $device;

    #[ORM\Column]
    private \DateTime $startedAt;

    #[ORM\Column]
    private \DateTime $expiredAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDevice(): Device
    {
        return $this->device;
    }

    public function setDevice(Device $device): Subscription
    {
        $this->device = $device;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): Subscription
    {
        $this->state = $state;
        return $this;
    }

    public function getReceipt(): string
    {
        return $this->receipt;
    }

    public function setReceipt(string $receipt): Subscription
    {
        $this->receipt = $receipt;
        return $this;
    }

    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTime $startedAt): Subscription
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    public function getExpiredAt(): \DateTime
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(\DateTime $expiredAt): Subscription
    {
        $this->expiredAt = $expiredAt;
        return $this;
    }
}
