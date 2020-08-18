<?php

namespace App\Entity\Business\UseCase\CreateBuisness;

class Command
{
    private $token;
    private $name;
    private $nip;
    private $adres;
    private $phone;
    private $description;
    private $responder;

    public function __construct(
        string $token,
        string $name,
        int $nip,
        string $adres,
        int $phone,
        string $description
    ){
        $this->token = $token;
        $this->name = $name;
        $this->nip = $nip;
        $this->adres = $adres;
        $this->phone = $phone;
        $this->description = $description;
        $this->responder = new NullResponder();
    }

    public function getToken(): string{
        return $this->token;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getNip(): int{
        return $this->nip;
    }

    public function getAdres(): string{
        return $this->adres;
    }

    public function getPhone(): int{
        return $this->phone;
    }

    public function getDescription(): string{
        return $this->description;
    }

    public function getResponder(): Responder{
        return $this->responder;
    }

    public function setResponder(Responder $responder) {
        $this->responder = $responder;

        return $this;
    }
}