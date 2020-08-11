<?php


namespace App\Entity\User\User\UseCase\PasswordReset;


use App\Entity\User\User;
use DateTime;

class Command
{

    private $user;
    private $Token;
    private $Token_Expire;
    private $responder;


    /**
     * Command constructor.
     * @param string $Token
     * @param DateTime $Token_Expire
     */
    public function __construct(
        User $user,
        string $Token,
        \DateTime $Token_Expire
    )
    {
        $this->user = $user;
        $this->Token = $Token;
        $this->Token_Expire = $Token_Expire;
        $this->responder = new NullResponder();
    }

    public function getUser(): User
    {
        return $this->user;
    }


    public function getToken(): ?string
    {
        return $this->Token;
    }


    public function getTokenExpire(): ?\DateTimeInterface
    {
        return $this->Token_Expire;
    }

    /**
     * @param Responder $responder
     */
    public function setResponder(Responder $responder): void
    {
        $this->responder = $responder;
    }

    public function getResponder(): Responder
    {
        return $this->responder;
    }
}