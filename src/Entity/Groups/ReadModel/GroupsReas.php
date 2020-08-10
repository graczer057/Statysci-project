<?php

namespace App\Entity\Groups\ReadModel;

class GroupsReas
{
    private $id;
    private $email;
    private $roles = [];
    private $name;
    private $password;
    private $token;
    private $token_expire;
    private $is_active;
    private $nip;
    private $description;

    public function getId(): ?int {
        return $this->id;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getRoles(): ?array {
        return $this->roles;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function getToken(): ?string {
        return $this->token;
    }

    public function getTokenExpire(): ?\DateTime {
        return $this->token_expire;
    }

    public function getIsActive(): ?bool {
        return $this->is_active;
    }

    public function getDescription(): ?string{
        return $this->description;
    }

    public function getNip(): ?int {
        return $this->nip;
    }
}