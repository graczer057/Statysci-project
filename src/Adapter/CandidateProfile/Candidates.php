<?php

namespace App\Adapter\CandidateProfile;

use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\CandidateProfil\CandidateProfilesInterface;
use App\Entity\User\User;
use Doctrine\Persistence\ObjectManager;

class Candidates implements CandidateProfilesInterface
{
    private $manager;

    public function __construct(
        ObjectManager $manager
    ){
        $this->manager = $manager;
    }

    public function add(CandidateProfil $candidate)
    {
        $this->manager->persist($candidate);
    }


}