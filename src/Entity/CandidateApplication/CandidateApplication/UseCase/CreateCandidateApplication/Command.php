<?php


namespace App\Entity\CandidateApplication\CandidateApplication\UseCase\CreateCandidateApplication;


use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\Offers\Offers;

class Command
{

    /**
     * @var Offers
     */
    private $Offer;
    /**
     * @var CandidateProfil
     */
    private $Candidate;
    /**
     * @var string
     */
    private $status;
    private $responder;


    public function __construct(
        Offers $Offer,
        CandidateProfil $Candidate,
        string $status
    )
    {
        $this->Offer = $Offer;
        $this->Candidate = $Candidate;
        $this->status = $status;
        $this->responder = new NullResponder();

    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return Offers
     */
    public function getOffer(): Offers
    {
        return $this->Offer;
    }

    /**
     * @return CandidateProfil
     */
    public function getCandidate(): CandidateProfil
    {
        return $this->Candidate;
    }

    /**
     * @return NullResponder
     */
    public function getResponder(): NullResponder
    {
        return $this->responder;
    }

    /**
     * @param NullResponder $responder
     */
    public function setResponder(NullResponder $responder): void
    {
        $this->responder = $responder;
    }
}