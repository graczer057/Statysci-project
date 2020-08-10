<?php

namespace App\Entity\Groups;

use App\Repository\GroupsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupsRepository::class)
 */
class Group implements GroupsInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoPath;

    public function __construct(
        string $name,
        string $email,
        int $nip,
        string $password,
        string $description,
        array $roles,
        string $token,
        \DateTime $token_expire,
        bool $is_active
    ){
        $non_active = false;
        $this->name = $name;
        $this->nip = $nip;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->roles = $roles;
        $this->description = $description;
        $this->is_active = $non_active;
        $this->token = md5(uniqid());
        $this->token_expire = new \DateTime('+60 minutes');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNip(): ?int
    {
        return $this->nip;
    }

    public function setNip(?int $nip): self
    {
        $this->nip = $nip;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhotoPath(): ?string
    {
        return $this->photoPath;
    }

    public function setPhotoPath(string $photoPath): self
    {
        $this->photoPath = $photoPath;

        return $this;
    }

    public function getRoles(): ?array {
        return $this->roles;
    }

    public function setRoles(array $roles): self {
        $this->roles = $roles;

        return $this;
    }

    public function getToken(): ?string {
        return $this->token;
    }

    public function setToken(string $token): self {
        $this->token = $token;

        return $this;
    }

    public function getTokenExpire(): \DateTime {
        return $this->token_expire;
    }

    public function setTokenExpire(\DateTime $token_expire): self {
        $this->token_expire = $token_expire;

        return $this;
    }

    public function getIsActive(): bool {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self {
        $this->is_active = $is_active;

        return $this;
    }

    public function add(Group $groups)
    {
        // TODO: Implement add() method.
    }

    public function findByToken(string $token)
    {
        // TODO: Implement findByToken() method.
    }

    public function findByName(string $name)
    {
        // TODO: Implement findByName() method.
    }
}
