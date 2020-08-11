<?php

namespace App\Entity\ActorGrupe\ReadModel;

use App\Entity\User\User;

class ActorGroups
{
    private $id;
    private $user;
    private $name;
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