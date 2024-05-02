<?php

namespace App\Entity;

use App\Entity\Trait\Timestamp;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity]
#[HasLifecycleCallbacks]
class Application
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $callbackUrl;

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Application
    {
        $this->name = $name;
        return $this;
    }

    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl(string $callbackUrl): Application
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }
}
