<?php

namespace App\Entity;

use App\Entity\Trait\Timestamp;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity]
#[HasLifecycleCallbacks]
class Device
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $uid;

    #[ORM\ManyToOne(Application::class, cascade: ["persist"])]
    private Application $application;

    #[ORM\ManyToOne(Language::class, cascade: ["persist"])]
    private Language $language;

    #[ORM\Column(type: 'string', length: 10)]
    private string $operatingSystem;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function setUid(string $uid): Device
    {
        $this->uid = $uid;
        return $this;
    }

    public function getApplication(): Application
    {
        return $this->application;
    }

    public function setApplication(Application $application): Device
    {
        $this->application = $application;
        return $this;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): Device
    {
        $this->language = $language;
        return $this;
    }

    public function getOperatingSystem(): string
    {
        return $this->operatingSystem;
    }

    public function setOperatingSystem(string $operatingSystem): Device
    {
        $this->operatingSystem = $operatingSystem;
        return $this;
    }
}
