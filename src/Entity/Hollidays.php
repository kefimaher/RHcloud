<?php

namespace App\Entity;

use App\Repository\HollidaysRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HollidaysRepository::class)]
class Hollidays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $day = null;
    #[ORM\Column(length: 180)]
    private ?string $discription = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getDay(): ?string
    {
        return $this->day;
    }

    /**
     * @param string|null $day
     */
    public function setDay(?string $day): void
    {
        $this->day = $day;
    }

    /**
     * @return string|null
     */
    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    /**
     * @param string|null $discription
     */
    public function setDiscription(?string $discription): void
    {
        $this->discription = $discription;
    }


}
