<?php

namespace App\Entity;

use App\Repository\CongeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CongeRepository::class)]
class Conge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $start_day = null;
    #[ORM\Column]
    private ?string $end_day = null;

    #[ORM\Column]
    private ?string $type_conge = null;

    #[ORM\Column]
    private ?string $cretification = null;

    #[ORM\Column]
    private array $day_number = [];
    #[ORM\Column]
    private ?string $statuts = null;
    #[ORM\Column]
    private ?string $discription = null;

    #[ORM\ManyToOne]
    private ?UserProfile $user_profile = null;






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserProfile(): ?string
    {
        return $this->user_profile;
    }

    public function setUserProfile(?string $user_profile): self
    {
        $this->user_profile = $user_profile;

        return $this;
    }

}
