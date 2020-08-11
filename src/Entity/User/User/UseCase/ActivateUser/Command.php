<?php

namespace App\Entity\User\User\UseCase\ActivateUser;

use App\Entity\User\User;

class Command
{
    private $user;
    private $token;
    private $token_expire;
    private $is_active;
    private $height;
    private $eyes;
    private $hair;
    private $weight;
    private $gender;
    private $responder;

    public function __construct(
        User $user,
        string $height,
        string $eyes,
        string $hair,
        string $weight,
        string $gender
    ){
        $nullToken = null;
        $activeUser = true;
        $this->user = $user;
        $this->token = $nullToken;
        $this->token_expire = $nullToken;
        $this->is_active = $activeUser;
        $this->height = $height;
        $this->eyes = $eyes;
        $this->hair = $hair;
        $this->weight = $weight;
        $this->gender = $gender;
        $this->responder = new NullResponder();
    }

    public function getUser(): User {
        return $this->user;
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

    public function getHeight(): string {
        return $this->height;
    }

    public function getEyes(): string {
        return $this->eyes;
    }

    public function getHair(): string {
        return $this->hair;
    }

    public function getWeight(): string {
        return $this->weight;
    }

    public function getGender(): string {
        return $this->gender;
    }

    public function getResponder(): Responder {
        return $this->responder;
    }

    public function setResponder(Responder $responder) {
        $this->responder = $responder;

        return $this;
    }
}