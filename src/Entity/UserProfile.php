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

    #[ORM\Column()]
    private ?int $employer_number = null;
    #[ORM\Column()]
    private ?int $id_conge = null;
    #[ORM\Column(length: 180)]
    private ?string $avatar = null;
    #[ORM\Column(length: 180)]
    private ?string $date_of_birth = null;
    #[ORM\Column(length: 180)]
    private ?string $adresse = null;
    #[ORM\Column(length: 180)]
    private ?string $country_code = null;
    #[ORM\Column()]
    private ?int $medical_file_number = null;
    #[ORM\Column(length: 180)]
    private ?string $join_date = null;
    #[ORM\Column(length: 180)]
    private ?string $email = null;
    #[ORM\Column()]
    private ?int $current_rank = null;
    #[ORM\Column()]
    private ?int $upper_hierarchy = null;
    #[ORM\Column()]
    private ?int $day_off_available = null;
    #[ORM\Column()]
    private ?int $sick_day = null;
    #[ORM\Column(length: 180)]
    private ?string $day_out = null;
    #[ORM\Column(length: 180)]
    private ?string $contract_type = null;
    #[ORM\Column(length: 180)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return int|null
     */
    public function getIdConge(): ?int
    {
        return $this->id_conge;
    }

    /**
     * @param int|null $id_conge
     */
    public function setIdConge(?int $id_conge): void
    {
        $this->id_conge = $id_conge;
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
    public function getDateOfBirth(): ?string
    {
        return $this->date_of_birth;
    }

    /**
     * @param string|null $date_of_birth
     */
    public function setDateOfBirth(?string $date_of_birth): void
    {
        $this->date_of_birth = $date_of_birth;
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
    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    /**
     * @param string|null $country_code
     */
    public function setCountryCode(?string $country_code): void
    {
        $this->country_code = $country_code;
    }

    /**
     * @return int|null
     */
    public function getMedicalFileNumber(): ?int
    {
        return $this->medical_file_number;
    }

    /**
     * @param int|null $medical_file_number
     */
    public function setMedicalFileNumber(?int $medical_file_number): void
    {
        $this->medical_file_number = $medical_file_number;
    }

    /**
     * @return string|null
     */
    public function getJoinDate(): ?string
    {
        return $this->join_date;
    }

    /**
     * @param string|null $join_date
     */
    public function setJoinDate(?string $join_date): void
    {
        $this->join_date = $join_date;
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
    public function getCurrentRank(): ?int
    {
        return $this->current_rank;
    }

    /**
     * @param int|null $current_rank
     */
    public function setCurrentRank(?int $current_rank): void
    {
        $this->current_rank = $current_rank;
    }

    /**
     * @return int|null
     */
    public function getUpperHierarchy(): ?int
    {
        return $this->upper_hierarchy;
    }

    /**
     * @param int|null $upper_hierarchy
     */
    public function setUpperHierarchy(?int $upper_hierarchy): void
    {
        $this->upper_hierarchy = $upper_hierarchy;
    }

    /**
     * @return int|null
     */
    public function getDayOffAvailable(): ?int
    {
        return $this->day_off_available;
    }

    /**
     * @param int|null $day_off_available
     */
    public function setDayOffAvailable(?int $day_off_available): void
    {
        $this->day_off_available = $day_off_available;
    }

    /**
     * @return int|null
     */
    public function getSickDay(): ?int
    {
        return $this->sick_day;
    }

    /**
     * @param int|null $sick_day
     */
    public function setSickDay(?int $sick_day): void
    {
        $this->sick_day = $sick_day;
    }

    /**
     * @return string|null
     */
    public function getDayOut(): ?string
    {
        return $this->day_out;
    }

    /**
     * @param string|null $day_out
     */
    public function setDayOut(?string $day_out): void
    {
        $this->day_out = $day_out;
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




}
