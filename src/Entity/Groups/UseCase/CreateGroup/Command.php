<?php

namespace App\Entity\Groups\UseCase\CreateGroup;

class Command
{
    private $name;
    private $nip;
    private $email;
    private $password;
    private $description;
    private $photoPath;
    private $roles = [];
    private $token;
    private $tokenExpire;
    private $isActive;
    private $date;
    private $responder;

    public function __construct(
        string $name,
        ?int $nip,
        string $email,
        string $password,
        array $roles,
        string $description
    ){
        $this->name = $name;
        $this->nip = $nip;
        $this->email = $email;
        $this->password = $password;
        $this->description = $description;
        $this->roles = $roles;
        $this->responder = new NullResponder();
    }

    public function getName(): string {
        return $this->name;
    }

    public function getNip(): ?int {
        return $this->nip;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPhotoPath(): ?string {
        return $this->photoPath;
    }

    public function getRoles(): array {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function getToken(): string {
        return $this->token;
    }

    public function getTokenExpire(): \DateTime {
        return $this->tokenExpire;
    }

    public function getIsActive(): bool {
        return $this->isActive;
    }

    public function getResponder(): Responder {
        return $this->responder;
    }

    public function setResponder(Responder $responder) {
        $this->responder = $responder;

        return $this;
    }
}