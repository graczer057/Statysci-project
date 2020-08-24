<?php


namespace App\Adapter\CandidatApplication;


use App\Entity\CandidateApplication\CandidateApplicationInterface;
use App\Entity\CandidateProfil\CandidateProfil;
use Doctrine\ORM\EntityManagerInterface;

class CandidatApplication implements CandidateApplicationInterface
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    public function add(\App\Entity\CandidateApplication\CandidatApplication $candidatApplication)
    {
        $this->manager->persist($candidatApplication);
    }
}