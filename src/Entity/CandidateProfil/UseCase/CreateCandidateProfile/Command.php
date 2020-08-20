<?php

namespace App\Entity\CandidateProfil\UseCase\CreateCandidateProfile;

class Command
{
    private $token;
    private $growth;
    private $physique;
    private $hair_length;
    private $hair_color;
    private $eye_color;
    private $age;
    private $responder;
    /**
     * @var string
     */
    private $Sex;

    public function __construct(
        string $token,
        int $growth,
        string $physique,
        string $hair_length,
        string $hair_color,
        string $eye_color,
        int $age,
        string $Sex
    ){
        $this->token = $token;
        $this->growth = $growth;
        $this->physique = $physique;
        $this->hair_length = $hair_length;
        $this->hair_color = $hair_color;
        $this->eye_color = $eye_color;
        $this->age = $age;
        $this->responder = new NullResponder();
        $this->Sex = $Sex;
    }

    public function getToken(): string{
        return $this->token;
    }

    public function getGrowth(): int{
        return $this->growth;
    }

    public function getPhysique(): string{
        return $this->physique;
    }

    public function getHairLength(): string{
        return $this->hair_length;
    }

    public function getHairColor(): string{
        return $this->hair_color;
    }

    public function getEyeColor(): string{
        return $this->eye_color;
    }

    public function getAge(): int{
        return $this->age;
    }

    public function getResponder(): Responder{
        return $this->responder;
    }

    public function setResponder(Responder $responder){
        $this->responder = $responder;

        return $this;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->Sex;
    }
}