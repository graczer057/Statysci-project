<?php
/**
 * Created by PhpStorm.
 * User: patry
 * Date: 06.08.2020
 * Time: 15:47
 */

namespace App\Entity\User\User\UseCase\CreateUser;


use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\Business\Business;
use App\Entity\CandidateProfil\CandidateProfil;

class Command
{


    private $email;
    private $roles = [];
    private $password;
    private $login;

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




}