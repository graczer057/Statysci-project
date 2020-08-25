<?php


namespace App\Entity\CandidateApplication\CandidateApplication\ReadModel;


use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\Offers\Offers;

class CandidateApplicationReadModel
{
    private $id;
    private $Offer;
    private $Candidate;
    private $DateAdd;
    private $status;

    public function __construct(
        int $id,
        Offers $Offer,
        CandidateProfil $Candidate,
        \DateTime $DateAdd,
        string $status
    )
    {
        $this->id = $id;
        $this->Offer = $Offer;
        $this->Candidate = $Candidate;
        $this->DateAdd = $DateAdd;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return CandidateProfil
     */
    public function getCandidate(): CandidateProfil
    {
        return $this->Candidate;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdd(): \DateTime
    {
        return $this->DateAdd;
    }

    /**
     * @return Offers
     */
    public function getOffer(): Offers
    {
        return $this->Offer;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}