<?php

namespace App\Entity\User\User\UseCase\ExpireUser;

use App\Entity\User\User;

class Command
{
    private $user;
    private $token;
    private $tokenExpire;
    private $responder;

    public function __construct(
        User $user,
        string $token,
        \DateTime $tokenExpire
    ){
        $this->user = $user;
        $this->token = $token;
        $this->tokenExpire = $tokenExpire;
        $this->responder = new NullResponder();
    }

    public function getUser(): User{
        return $this->user;
    }

    public function getToken(): string{
        return $this->token;
    }

    public function getTokenExpire(): \DateTime{
        return $this->tokenExpire;
    }

    public function getResponder(): Responder{
        return $this->responder;
    }

    public function setResponder(Responder $responder){
        $this->responder = $responder;

        return $this;
    }
}