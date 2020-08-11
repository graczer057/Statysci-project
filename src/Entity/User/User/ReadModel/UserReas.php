<?php

namespace App\Entity\User\User\ReadModel;

class UserReas
{

    private $id;
    private $email;
    private $roles = [];
    private $password;
    private $token;
    private $token_expire;
    private $is_active;
    private $photo;
    private $login;
    private $business;
    private $candidateProfil;
    private $actorGrupe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getTokenExpire(): ?\DateTimeInterface
    {
        return $this->token_expire;
    }


    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }


    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }


    public function getBusiness(): ?Business
    {
        return $this->business;
    }


    public function getCandidateProfil(): ?CandidateProfil
    {
        return $this->candidateProfil;
    }


    public function getActorGrupe(): ?ActorGrupe
    {
        return $this->actorGrupe;
    }


}