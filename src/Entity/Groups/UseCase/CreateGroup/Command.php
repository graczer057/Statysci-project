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
        int $nip,
        string $email,
        string $password,
        array $roles,
        string $description
    ){
        $falseActive = false;
        $nullVariable = null;
        $this->name = $name;
        $this->nip = $nip;
        $this->email = $email;
        $this->password = $password;
        $this->description = $description;
        $this->photoPath = $nullVariable;
        $this->roles = $roles;
        $this->token = md5(uniqid());
        $this->date = new \DateTime("now");
        $this->date->modify('+60 minutes');
        $this->tokenExpire = $this->date;
        $this->isActive = $falseActive;
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
        
    }
}