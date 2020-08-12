<?php

namespace App\Entity\Business\ReadModel;

use App\Entity\User\User;

class Business
{
    private $id;
    private $user;
    private $name;
    private $nip;
    private $adres;
    private $phone;
    private $description;

    public function getId(): ?int {
        return $this->id;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getNip(): ?int {
        return $this->nip;
    }

    public function getAdres(): ?string {
        return $this->adres;
    }

    public function getPhone(): ?int {
        return $this->phone;
    }

    public function getDescription(): ?string {
        return $this->description;
    }
}