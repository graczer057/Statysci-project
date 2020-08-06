<?php

namespace App\Entity\SendOfferGrupe;

use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Repository\SendOfferGrupe\SendOfferGrupeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SendOfferGrupeRepository::class)
 */
class SendOfferGrupe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ActorGrupe::class, inversedBy="sendOfferGrupes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Grupe;

    /**
     * @ORM\ManyToOne(targetEntity=CandidateProfil::class, inversedBy="sendOfferGrupes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Candidat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $SendDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Is_send;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrupe(): ?ActorGrupe
    {
        return $this->Grupe;
    }

    public function setGrupe(?ActorGrupe $Grupe): self
    {
        $this->Grupe = $Grupe;

        return $this;
    }

    public function getCandidat(): ?CandidateProfil
    {
        return $this->Candidat;
    }

    public function setCandidat(?CandidateProfil $Candidat): self
    {
        $this->Candidat = $Candidat;

        return $this;
    }

    public function getSendDate(): ?\DateTimeInterface
    {
        return $this->SendDate;
    }

    public function setSendDate(\DateTimeInterface $SendDate): self
    {
        $this->SendDate = $SendDate;

        return $this;
    }

    public function getIsSend(): ?bool
    {
        return $this->Is_send;
    }

    public function setIsSend(bool $Is_send): self
    {
        $this->Is_send = $Is_send;

        return $this;
    }
}
