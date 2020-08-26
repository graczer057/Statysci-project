<?php

namespace App\Entity\CandidateApplication;

use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\Offers\Offers;
use App\Repository\CandidateApplication\CandidatApplicationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidatApplicationRepository::class)
 */
class CandidatApplication
{

    public const STATUS_WAITING='waiting';
    public const STATUS_ACCEPTED='accepted';
    public const STATUS_REJECTED='rejected';
    public const STATUS=[
        self::STATUS_ACCEPTED=>"zaakceptowany",
        self::STATUS_REJECTED=>'odrzucony',
        self::STATUS_WAITING=>'Oczekujący'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Offers::class, inversedBy="candidatApplications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Offer;

    /**
     * @ORM\ManyToOne(targetEntity=CandidateProfil::class, inversedBy="candidatApplications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Candidate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateAdd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;


    public function __construct(
        Offers $Offer,
        CandidateProfil $Candidate,
        string $status
    )
    {
        $this->Offer = $Offer;
        $this->Candidate = $Candidate;
        $this->status = $status;
        $this->DateAdd = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffer(): ?Offers
    {
        return $this->Offer;
    }

    public function setOffer(?Offers $Offer): self
    {
        $this->Offer = $Offer;

        return $this;
    }

    public function getCandidate(): ?CandidateProfil
    {
        return $this->Candidate;
    }

    public function setCandidate(?CandidateProfil $Candidate): self
    {
        $this->Candidate = $Candidate;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->DateAdd;
    }

    public function setDateAdd(\DateTimeInterface $DateAdd): self
    {
        $this->DateAdd = $DateAdd;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
