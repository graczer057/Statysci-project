<?php

namespace App\Entity\User\User\UseCase\CreateUser;

use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\Business\Business;
use App\Entity\CandidateProfil\CandidateProfil;
use phpDocumentor\Reflection\Types\This;

class Command
{

    private $email;
    private $roles = [];
    private $password;
    private $login;
    private $responder;
    private $token;
    private $token_expire;
    private $is_active;
    private $date;

    public function __construct(
        string $login,
        string $email,
        array $roles,
        string $password
    )
    {
        $falseActive = false;
        $this->login = $login;
        $this->email = $email;
        $this->roles = $roles;
        $this->password = $password;
        $this->token = md5(uniqid());
        $this->date = new \DateTime("now");
        $this->date->modify('+60 minutes');
        $this->token_expire = $this->date;
        $this->is_active = $falseActive;
        $this->responder = new NullResponder();
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


    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function getToken(): ?string {
        return $this->token;
    }

    public function getTokenExpire(): \DateTime {
        return $this->token_expire;
    }

    public function getIsActive(): ?bool {
        return $this->is_active;
    }

    public function getResponder(): Responder {
        return $this->responder;
    }

    public function setResponder(Responder $responder) {
        $this->responder = $responder;

        return $this;
    }
}