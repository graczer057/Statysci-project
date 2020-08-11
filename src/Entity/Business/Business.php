<?php

namespace App\Entity\Business;

use App\Entity\SendOfferBusiness\SendOfferBusiness;
use App\Entity\User\User;
use App\Repository\Business\BusinessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BusinessRepository::class)
 */
class Business
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="integer")
     */
    private $NIP;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adres;

    /**
     * @ORM\Column(type="integer")
     */
    private $Phone;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="business", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity=SendOfferBusiness::class, mappedBy="Business")
     */
    private $sendOfferBusinesses;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->sendOfferBusinesses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getNIP(): ?int
    {
        return $this->NIP;
    }

    public function setNIP(int $NIP): self
    {
        $this->NIP = $NIP;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->Adres;
    }

    public function setAdres(string $Adres): self
    {
        $this->Adres = $Adres;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->Phone;
    }

    public function setPhone(int $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection|SendOfferBusiness[]
     */
    public function getSendOfferBusinesses(): Collection
    {
        return $this->sendOfferBusinesses;
    }

    public function addSendOfferBusiness(SendOfferBusiness $sendOfferBusiness): self
    {
        if (!$this->sendOfferBusinesses->contains($sendOfferBusiness)) {
            $this->sendOfferBusinesses[] = $sendOfferBusiness;
            $sendOfferBusiness->setBusiness($this);
        }

        return $this;
    }

    public function removeSendOfferBusiness(SendOfferBusiness $sendOfferBusiness): self
    {
        if ($this->sendOfferBusinesses->contains($sendOfferBusiness)) {
            $this->sendOfferBusinesses->removeElement($sendOfferBusiness);
            // set the owning side to null (unless already changed)
            if ($sendOfferBusiness->getBusiness() === $this) {
                $sendOfferBusiness->setBusiness(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
