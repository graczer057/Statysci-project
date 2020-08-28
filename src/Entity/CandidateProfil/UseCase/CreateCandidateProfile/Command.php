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
    private $Sex;
    private $FirstName;
    private $Surname;

    public function __construct(
        string $token,
        int $growth,
        string $physique,
        string $hair_length,
        string $hair_color,
        string $eye_color,
        int $age,
        string $Sex,
        string $FirstName,
        string $Surname
    ){
        $this->token = $token;
        $this->growth = $growth;
        $this->physique = $physique;
        $this->hair_length = $hair_length;
        $this->hair_color = $hair_color;
        $this->eye_color = $eye_color;
        $this->age = $age;
        $this->Sex = $Sex;
        $this->FirstName = $FirstName;
        $this->Surname = $Surname;
        $this->responder = new NullResponder();
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

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->FirstName;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->Surname;
    }
}