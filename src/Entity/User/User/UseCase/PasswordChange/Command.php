<?php


namespace App\Entity\User\User\UseCase\PasswordChange;


use App\Entity\User\User;
use DateTime;


class Command
{
    private $user;
    private $Token;
    private $Token_Expire;
    private $responder;
    private $password;


    /**
     * Command constructor.
     * @param bool $Is_active
     * @param string $Token
     * @param DateTime $Token_Expire
     */
    public function __construct(
        User $user,
        string $password,
        ?string $Token,
        ?\DateTime $Token_Expire
    )
    {
        $this->user = $user;
        $this->password=$password;
        $this->Token = $Token;
        $this->Token_Expire = $Token_Expire;
        $this->responder = new NullResponder();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return (string) $this->password;
    }


    public function getToken(): ?string
    {
        return $this->Token;
    }


    public function getTokenExpire(): ?\DateTimeInterface
    {
        return $this->Token_Expire;
    }


    public function getResponder(): Responder
    {
        return $this->responder;
    }
    /**
     * @param Responder $responder
     */
    public function setResponder(Responder $responder): void
    {
        $this->responder = $responder;
    }

}