<?php


namespace App\Entity\CandidateProfil\UseCase\CreateCandidateProfile;


use App\Entity\User\User;

class Command
{

    private $User;

    public function __construct(
        User $User
    )
    {
        $this->User = $User;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

}