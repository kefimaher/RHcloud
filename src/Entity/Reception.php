<?php

namespace App\Entity;
use App\Repository\CongeRepository;
use Doctrine\ORM\Mapping as ORM;
class Reception
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 180)]
    private ?string $question = null;
    #[ORM\Column(length: 180)]
    private ?string $statut = null;
    #[ORM\Column(length: 180)]
    private ?string $repence = null;
    #[ORM\Column(length: 180)]
    private ?string $datequestion = null;
    #[ORM\Column(length: 180)]
    private ?string $datereponce = null;
    #[ORM\ManyToOne]
    private ?UserProfile $user_profile = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    /**
     * @param string|null $question
     */
    public function setQuestion(?string $question): void
    {
        $this->question = $question;
    }

    /**
     * @return string|null
     */
    public function getStatut(): ?string
    {
        return $this->statut;
    }

    /**
     * @param string|null $statut
     */
    public function setStatut(?string $statut): void
    {
        $this->statut = $statut;
    }

    /**
     * @return string|null
     */
    public function getRepence(): ?string
    {
        return $this->repence;
    }

    /**
     * @param string|null $repence
     */
    public function setRepence(?string $repence): void
    {
        $this->repence = $repence;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return UserProfile|null
     */
    public function getUserProfile(): ?UserProfile
    {
        return $this->user_profile;
    }

    /**
     * @param UserProfile|null $user_profile
     */
    public function setUserProfile(?UserProfile $user_profile): void
    {
        $this->user_profile = $user_profile;
    }

    /**
     * @return string|null
     */
    public function getDatequestion(): ?string
    {
        return $this->datequestion;
    }

    /**
     * @param string|null $datequestion
     */
    public function setDatequestion(?string $datequestion): void
    {
        $this->datequestion = $datequestion;
    }

    /**
     * @return string|null
     */
    public function getDatereponce(): ?string
    {
        return $this->datereponce;
    }

    /**
     * @param string|null $datereponce
     */
    public function setDatereponce(?string $datereponce): void
    {
        $this->datereponce = $datereponce;
    }


}