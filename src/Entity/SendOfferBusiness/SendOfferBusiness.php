<?php

namespace App\Entity\SendOfferBusiness;

use App\Entity\Business\Business;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Repository\SendOfferBusiness\SendOfferBusinessRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SendOfferBusinessRepository::class)
 */
class SendOfferBusiness
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Business::class, inversedBy="sendOfferBusinesses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Business;

    /**
     * @ORM\ManyToOne(targetEntity=CandidateProfil::class, inversedBy="sendOfferBusiness")
     */
    private $Candidate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $SendData;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_send;

    public function __construct(
        Business $Business,
        CandidateProfil $Candidate,
        bool $is_send=true
    )
    {
        $this->Business = $Business;
        $this->Candidate = $Candidate;
        $this->SendData =  new DateTime('now');
        $this->is_send = $is_send;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBusiness(): ?Business
    {
        return $this->Business;
    }

    public function setBusiness(?Business $Business): self
    {
        $this->Business = $Business;

        return $this;
    }

    /**
     * @return Collection|CandidateProfil[]
     */
    public function getCandidate(): Collection
    {
        return $this->Candidate;
    }

    public function addCandidate(CandidateProfil $candidate): self
    {
        if (!$this->Candidate->contains($candidate)) {
            $this->Candidate[] = $candidate;
            $candidate->setSendOfferBusiness($this);
        }

        return $this;
    }

    public function removeCandidate(CandidateProfil $candidate): self
    {
        if ($this->Candidate->contains($candidate)) {
            $this->Candidate->removeElement($candidate);
            // set the owning side to null (unless already changed)
            if ($candidate->getSendOfferBusiness() === $this) {
                $candidate->setSendOfferBusiness(null);
            }
        }

        return $this;
    }

    public function getSendData(): ?\DateTimeInterface
    {
        return $this->SendData;
    }

    public function setSendData(\DateTimeInterface $SendData): self
    {
        $this->SendData = $SendData;

        return $this;
    }

    public function getIsSend(): ?bool
    {
        return $this->is_send;
    }

    public function setIsSend(bool $is_send): self
    {
        $this->is_send = $is_send;

        return $this;
    }
}
