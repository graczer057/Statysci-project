<?php


namespace App\Adapter\Candidate;


use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\CandidateProfil\CandidateProfilesInterface;
use Doctrine\ORM\EntityManagerInterface;

final class Candidate implements CandidateProfilesInterface
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    public function add(CandidateProfil $candidateProfil)
    {
        $this->manager->persist($candidateProfil);
    }

}