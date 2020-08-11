<?php

namespace App\Entity\User;

use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\Business\Business;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Repository\User\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{


    public function Role(int $id){
        $role[1]=['Candidate'];
        $role[2]=['Business'];
        $role[3]=['Groupe'];
        return $role[$id];
    }


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $token_expire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eyes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hair;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\OneToOne(targetEntity=Business::class, mappedBy="User", cascade={"persist", "remove"})
     */
    private $business;

    /**
     * @ORM\OneToOne(targetEntity=CandidateProfil::class, mappedBy="User", cascade={"persist", "remove"})
     */
    private $candidateProfil;

    /**
     * @ORM\OneToOne(targetEntity=ActorGrupe::class, mappedBy="User", cascade={"persist", "remove"})
     */
    private $actorGrupe;


    public function __construct(
        string $login,
        string $email,
        string $password,
        array $roles,
        ?string $height,
        ?string $eyes,
        ?string $hair,
        ?string $weight,
        ?string $gender,
        bool $is_active=false
    )
    {
        $this->login = $login;
        $this->email = $email;
        $this->password =  password_hash($password, PASSWORD_BCRYPT);
        $this->roles = $roles;
        $this->is_active = $is_active;
        $this->token = md5(uniqid(time()));
        $this->token_expire = new DateTime('+60 minutes');
        $this->height = $height;
        $this->eyes = $eyes;
        $this->hair = $hair;
        $this->weight = $weight;
        $this->gender = $gender;
    }


    public function activateUser(
        ?string $token,
        ?\DateTime $token_expire,
        ?bool $is_active,
        ?string $height,
        ?string $eyes,
        ?string $hair,
        ?string $weight,
        ?string $gender
    ){
        $activeUser = true;
        $nullToken = null;
        $this->token = $nullToken;
        $this->token_expire = $nullToken;
        $this->is_active = $activeUser;
        $this->height = $height;
        $this->eyes = $eyes;
        $this->hair = $hair;
        $this->weight = $weight;
        $this->gender = $gender;
    }

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
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getTokenExpire(): ?\DateTimeInterface
    {
        return $this->token_expire;
    }

    public function setTokenExpire(?\DateTimeInterface $token_expire): self
    {
        $this->token_expire = $token_expire;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getBusiness(): ?Business
    {
        return $this->business;
    }

    public function setBusiness(Business $business): self
    {
        $this->business = $business;

        // set the owning side of the relation if necessary
        if ($business->getUser() !== $this) {
            $business->setUser($this);
        }

        return $this;
    }

    public function getCandidateProfil(): ?CandidateProfil
    {
        return $this->candidateProfil;
    }

    public function setCandidateProfil(?CandidateProfil $candidateProfil): self
    {
        $this->candidateProfil = $candidateProfil;

        // set (or unset) the owning side of the relation if necessary
        $newUser = null === $candidateProfil ? null : $this;
        if ($candidateProfil->getUser() !== $newUser) {
            $candidateProfil->setUser($newUser);
        }

        return $this;
    }

    public function getActorGrupe(): ?ActorGrupe
    {
        return $this->actorGrupe;
    }

    public function setActorGrupe(ActorGrupe $actorGrupe): self
    {
        $this->actorGrupe = $actorGrupe;

        // set the owning side of the relation if necessary
        if ($actorGrupe->getUser() !== $this) {
            $actorGrupe->setUser($this);
        }

        return $this;
    }

    public function getRoleName(): ?int{
        return self::Role($this->getRoleName());
    }

    /**
     * @return mixed
     */
    public function getHeight(): ?string
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getEyes(): ?string
    {
        return $this->eyes;
    }

    /**
     * @param mixed $eyes
     */
    public function setEyes($eyes): void
    {
        $this->eyes = $eyes;
    }

    /**
     * @return mixed
     */
    public function getHair(): ?string
    {
        return $this->hair;
    }

    /**
     * @param mixed $hair
     */
    public function setHair($hair): void
    {
        $this->hair = $hair;
    }

    /**
     * @return mixed
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    public function TokenExpire(
        ?string $Token,
        ?\DateTime $Token_Expire
    ){
        $this->Token = $Token;
        $this->Token_Expire = $Token_Expire;
    }
}
