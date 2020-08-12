<?php

namespace App\Entity\CandidateProfil;

use App\Entity\SendOfferBusiness\SendOfferBusiness;
use App\Entity\SendOfferGrupe\SendOfferGrupe;
use App\Entity\User\User;
use App\Repository\CandidateProfil\CandidateProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidateProfilRepository::class)
 */
class CandidateProfil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Growth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $physique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Hair_Length;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Hair_Color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Eye_Color;

    /**
     * @ORM\Column(type="integer")
     */
    private $Age;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="candidateProfil", cascade={"persist", "remove"})
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity=SendOfferBusiness::class, mappedBy="Candidate")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sendOfferBusiness;

    /**
     * @ORM\OneToMany(targetEntity=SendOfferGrupe::class, mappedBy="Candidat")
     */
    private $sendOfferGrupes;

    public function __construct(
        User $user,
        int $growth,
        string $physique,
        string $Hair_Length,
        string $Hair_Color,
        string $Eye_Color,
        int $Age
    )
    {
        $this->User = $user;
        $this->Growth = $growth;
        $this->physique = $physique;
        $this->Hair_Length = $Hair_Length;
        $this->Hair_Color = $Hair_Color;
        $this->Eye_Color = $Eye_Color;
        $this->Age = $Age;
        $this->sendOfferGrupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrowth(): ?int
    {
        return $this->Growth;
    }

    public function setGrowth(int $Growth): self
    {
        $this->Growth = $Growth;

        return $this;
    }

    public function getPhysique(): ?string
    {
        return $this->physique;
    }

    public function setPhysique(string $physique): self
    {
        $this->physique = $physique;

        return $this;
    }

    public function getHairLength(): ?string
    {
        return $this->Hair_Length;
    }

    public function setHairLength(string $Hair_Length): self
    {
        $this->Hair_Length = $Hair_Length;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->Hair_Color;
    }

    public function setHairColor(string $Hair_Color): self
    {
        $this->Hair_Color = $Hair_Color;

        return $this;
    }

    public function getEyeColor(): ?string
    {
        return $this->Eye_Color;
    }

    public function setEyeColor(string $Eye_Color): self
    {
        $this->Eye_Color = $Eye_Color;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getSendOfferBusiness(): ?SendOfferBusiness
    {
        return $this->sendOfferBusiness;
    }

    public function setSendOfferBusiness(?SendOfferBusiness $sendOfferBusiness): self
    {
        $this->sendOfferBusiness = $sendOfferBusiness;

        return $this;
    }

    /**
     * @return Collection|SendOfferGrupe[]
     */
    public function getSendOfferGrupes(): Collection
    {
        return $this->sendOfferGrupes;
    }

    public function addSendOfferGrupe(SendOfferGrupe $sendOfferGrupe): self
    {
        if (!$this->sendOfferGrupes->contains($sendOfferGrupe)) {
            $this->sendOfferGrupes[] = $sendOfferGrupe;
            $sendOfferGrupe->setCandidat($this);
        }

        return $this;
    }

    public function removeSendOfferGrupe(SendOfferGrupe $sendOfferGrupe): self
    {
        if ($this->sendOfferGrupes->contains($sendOfferGrupe)) {
            $this->sendOfferGrupes->removeElement($sendOfferGrupe);
            // set the owning side to null (unless already changed)
            if ($sendOfferGrupe->getCandidat() === $this) {
                $sendOfferGrupe->setCandidat(null);
            }
        }

        return $this;
    }
}
