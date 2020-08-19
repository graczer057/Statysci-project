<?php


namespace App\Entity\SendOfferGrupe\UseCase\CreateSendOfferGroup;


use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\CandidateProfil\CandidateProfil;

class Command
{


    /**
     * @var ActorGrupe
     */
    private $actorGrupe;
    /**
     * @var CandidateProfil
     */
    private $candidateProfil;

    public function __construct(
        ActorGrupe $actorGrupe,
        CandidateProfil $candidateProfil
    )
    {
        $this->actorGrupe = $actorGrupe;
        $this->candidateProfil = $candidateProfil;
    }

    /**
     * @return CandidateProfil
     */
    public function getCandidateProfil(): CandidateProfil
    {
        return $this->candidateProfil;
    }

    /**
     * @return ActorGrupe
     */
    public function getActorGrupe(): ActorGrupe
    {
        return $this->actorGrupe;
    }
}