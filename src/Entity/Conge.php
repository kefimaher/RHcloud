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
    #[ORM\Column(nullable: true)]
    private ?string $start_day = null;
    #[ORM\Column(nullable: true)]
    private ?string $end_day = null;
    #[ORM\Column(nullable: true)]
    private ?string $type_conge = null;
    #[ORM\Column(nullable: true)]
    private ?string $cretification = null;
    #[ORM\Column(nullable: true)]
    private ?int $nombredujour = null;
    #[ORM\Column(nullable: true)]
    private ?string $statuts = null;

    #[ORM\Column(nullable: true)]
    private ?string $avatar = null;
    #[ORM\Column(nullable: true)]
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
    /**
     * @return string|null
     */
    public function getStartDay(): ?string
    {
        return $this->start_day;
    }
    /**
     * @param string|null $start_day
     */
    public function setStartDay(?string $start_day): void
    {
        $this->start_day = $start_day;
    }
    /**
     * @return string|null
     */
    public function getEndDay(): ?string
    {
        return $this->end_day;
    }
    /**
     * @param string|null $end_day
     */
    public function setEndDay(?string $end_day): void
    {
        $this->end_day = $end_day;
    }
    /**
     * @return string|null
     */
    public function getTypeConge(): ?string
    {
        return $this->type_conge;
    }
    /**
     * @param string|null $type_conge
     */
    public function setTypeConge(?string $type_conge): void
    {
        $this->type_conge = $type_conge;
    }
    /**
     * @return string|null
     */
    public function getCretification(): ?string
    {
        return $this->cretification;
    }
    /**
     * @param string|null $cretification
     */
    public function setCretification(?string $cretification): void
    {
        $this->cretification = $cretification;
    }
    /**
     * @return string|null
     */
    public function getStatuts(): ?string
    {
        return $this->statuts;
    }
    /**
     * @param string|null $statuts
     */
    public function setStatuts(?string $statuts): void
    {
        $this->statuts = $statuts;
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
    /**
     * @return int|null
     */
    public function getNombredujour(): ?int
    {
        return $this->nombredujour;
    }
    /**
     * @param int|null $nombredujour
     */
    public function setNombredujour(?int $nombredujour): void
    {
        $this->nombredujour = $nombredujour;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string|null $avatar
     */
    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }
}
