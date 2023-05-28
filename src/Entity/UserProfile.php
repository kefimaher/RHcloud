<?php

namespace App\Entity;

use App\Repository\UserProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserProfileRepository::class)]
class UserProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(nullable: true)]
    private ?int $idconge = null;
    #[ORM\Column(nullable: true)]
    private ?string $dateofbirth = null;

    #[ORM\Column(nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    private ?string $countrycode = null;
    #[ORM\Column(nullable: true)]
    private ?int $medicalfilenumber = null;
    #[ORM\Column(nullable: true)]
    private ?string $joindate = null;
    #[ORM\Column(nullable: true)]
    private ?int $currentrank = null;
    #[ORM\Column(nullable: true)]
    private ?int $upperhierarchy = null;
    #[ORM\Column(nullable: true)]
    private ?int $dayoffavailable = null;
    #[ORM\Column(nullable: true)]
    private ?int $sickday = null;
    #[ORM\Column(nullable: true)]
    private ?string $dayout = null;
    #[ORM\Column(nullable: true)]
    private ?string $contract_type = null;

    #[ORM\Column(nullable: true)]
    private ?string $status = null;
    #[ORM\Column(nullable: true)]
    private ?int $employer_number = null;

    #[ORM\Column(nullable: true)]
    private ?int $telephone = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getIdconge(): ?int
    {
        return $this->idconge;
    }

    /**
     * @param int|null $idconge
     */
    public function setIdconge(?int $idconge): void
    {
        $this->idconge = $idconge;
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

    /**
     * @return string|null
     */
    public function getDateofbirth(): ?string
    {
        return $this->dateofbirth;
    }

    /**
     * @param string|null $dateofbirth
     */
    public function setDateofbirth(?string $dateofbirth): void
    {
        $this->dateofbirth = $dateofbirth;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string|null $adresse
     */
    public function setAdresse(?string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string|null
     */
    public function getCountrycode(): ?string
    {
        return $this->countrycode;
    }

    /**
     * @param string|null $countrycode
     */
    public function setCountrycode(?string $countrycode): void
    {
        $this->countrycode = $countrycode;
    }

    /**
     * @return int|null
     */
    public function getMedicalfilenumber(): ?int
    {
        return $this->medicalfilenumber;
    }

    /**
     * @param int|null $medicalfilenumber
     */
    public function setMedicalfilenumber(?int $medicalfilenumber): void
    {
        $this->medicalfilenumber = $medicalfilenumber;
    }

    /**
     * @return string|null
     */
    public function getJoindate(): ?string
    {
        return $this->joindate;
    }

    /**
     * @param string|null $joindate
     */
    public function setJoindate(?string $joindate): void
    {
        $this->joindate = $joindate;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int|null
     */
    public function getCurrentrank(): ?int
    {
        return $this->currentrank;
    }

    /**
     * @param int|null $currentrank
     */
    public function setCurrentrank(?int $currentrank): void
    {
        $this->currentrank = $currentrank;
    }

    /**
     * @return int|null
     */
    public function getUpperhierarchy(): ?int
    {
        return $this->upperhierarchy;
    }

    /**
     * @param int|null $upperhierarchy
     */
    public function setUpperhierarchy(?int $upperhierarchy): void
    {
        $this->upperhierarchy = $upperhierarchy;
    }

    /**
     * @return int|null
     */
    public function getDayoffavailable(): ?int
    {
        return $this->dayoffavailable;
    }

    /**
     * @param int|null $dayoffavailable
     */
    public function setDayoffavailable(?int $dayoffavailable): void
    {
        $this->dayoffavailable = $dayoffavailable;
    }

    /**
     * @return int|null
     */
    public function getSickday(): ?int
    {
        return $this->sickday;
    }

    /**
     * @param int|null $sickday
     */
    public function setSickday(?int $sickday): void
    {
        $this->sickday = $sickday;
    }

    /**
     * @return string|null
     */
    public function getDayout(): ?string
    {
        return $this->dayout;
    }

    /**
     * @param string|null $dayout
     */
    public function setDayout(?string $dayout): void
    {
        $this->dayout = $dayout;
    }

    /**
     * @return string|null
     */
    public function getContractType(): ?string
    {
        return $this->contract_type;
    }

    /**
     * @param string|null $contract_type
     */
    public function setContractType(?string $contract_type): void
    {
        $this->contract_type = $contract_type;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getEmployerNumber(): ?int
    {
        return $this->employer_number;
    }

    /**
     * @param int|null $employer_number
     */
    public function setEmployerNumber(?int $employer_number): void
    {
        $this->employer_number = $employer_number;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setProfile(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getProfile() !== $this) {
            $user->setProfile($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    /**
     * @param int|null $telephone
     */
    public function setTelephone(?int $telephone): void
    {
        $this->telephone = $telephone;
    }




}
