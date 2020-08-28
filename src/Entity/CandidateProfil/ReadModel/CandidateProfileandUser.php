<?php

namespace App\Entity\CandidateProfil\ReadModel;

use App\Entity\User\User;

class CandidateProfileandUser
{
    private $id;
    private $user;
    private $growth;
    private $physique;
    private $hair_length;
    private $hair_color;
    private $eye_color;
    private $age;
    private $Sex;
    private $FirstName;
    private $Surname;

    public function __construct(
        int $id,
        User $user,
        int $growth,
        string $physique,
        string $hair_length,
        string $hair_color,
        string $eye_color,
        int $age,
        string $FirstName,
        string $Surname,
        string $Sex
    ){
        $this->id = $id;
        $this->user = $user;
        $this->growth = $growth;
        $this->physique = $physique;
        $this->hair_length = $hair_length;
        $this->hair_color = $hair_color;
        $this->eye_color = $eye_color;
        $this->age = $age;
        $this->Sex = $Sex;
        $this->FirstName = $FirstName;
        $this->Surname = $Surname;
    }

    public function getGrowth(): ?string {
        return $this->growth;
    }

    public function getPhysique(): ?string {
        return $this->physique;
    }

    public function getHairLength(): ?string {
        return $this->hair_length;
    }

    public function getHairColor(): ?string {
        return $this->hair_color;
    }

    public function getEyeColor(): ?string {
        return $this->eye_color;
    }

    public function getAge(): ?int {
        return $this->age;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }


    public function getSurname(): string
    {
        return $this->Surname;
    }

    public function getFirstName(): string
    {
        return $this->FirstName;
    }

    public function getSex(): string
    {
        return $this->Sex;
    }
}