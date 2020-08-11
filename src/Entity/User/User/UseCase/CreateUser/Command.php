<?php

namespace App\Entity\User\User\UseCase\CreateUser;

class Command
{
    private $email;
    private $roles = [];
    private $password;
    private $login;
    private $token;
    private $token_expire;
    private $is_active;
    private $date;
    private $responder;

    public function __construct(
        string $login,
        string $email,
        array $roles,
        string $password
    )
    {
        $this->login = $login;
        $this->email = $email;
        $this->roles = $roles;
        $this->password = $password;
        $this->responder = new NullResponder();
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