<?php


namespace App\Entity\SendOfferBusiness\UseCase\CreateSendOfferBuisness;


use App\Entity\Business\Business;
use App\Entity\CandidateProfil\CandidateProfil;

class Command
{

    /**
     * @var Business
     */
    private $business;
    /**
     * @var CandidateProfil
     */
    private $candidateProfil;

    public function __construct(
        Business $business,
        CandidateProfil $candidateProfil
    )
    {
        $this->business = $business;
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
     * @return Business
     */
    public function getBusiness(): Business
    {
        return $this->business;
    }

}