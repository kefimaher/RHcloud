<?php
namespace App\Entity;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;
    #[ORM\Column]
    private ?string $firstname = null;
    #[ORM\Column]
    private ?string $lastname = null;
    #[ORM\Column]
    private ?string $fonction = null;
    #[ORM\Column]
    private ?int $employernumber = null;
    #[ORM\Column(nullable: true)]
    private ?string $avatar = null;
    #[ORM\Column]
    private ?string $realpassword = null;

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
    #[ORM\Column]
    private array $roles = [];
    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;
    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?UserProfile $profile = null;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    /**
     * @return string|null
     */
    public function getRealpassword(): ?string
    {
        return $this->realpassword;
    }
    /**
     * @param string|null $realpassword
     */
    public function setRealpassword(?string $realpassword): void
    {
        $this->realpassword = $realpassword;
    }
    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    /**
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }
    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    /**
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }
    /**
     * @return string|null
     */
    public function getFonction(): ?string
    {
        return $this->fonction;
    }
    /**
     * @param string|null $fonction
     */
    public function setFonction(?string $fonction): void
    {
        $this->fonction = $fonction;
    }
    public function getProfile(): ?UserProfile
    {
        return $this->profile;
    }
    public function setProfile(?UserProfile $profile): self
    {
        $this->profile = $profile;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEmployernumber(): ?int
    {
        return $this->employernumber;
    }

    /**
     * @param int|null $employernumber
     */
    public function setEmployernumber(?int $employernumber): void
    {
        $this->employernumber = $employernumber;
    }


}
