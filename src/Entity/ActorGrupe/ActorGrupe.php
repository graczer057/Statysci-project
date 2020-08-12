<?php

namespace App\Entity\ActorGrupe;

use App\Entity\SendOfferGrupe\SendOfferGrupe;
use App\Entity\User\User;
use App\Repository\ActorGrupe\ActorGrupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActorGrupeRepository::class)
 */
class ActorGrupe
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
     * @ORM\Column(type="string", length=255)
     */
    private $Adres;

    /**
     * @ORM\Column(type="integer")
     */
    private $Phone;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="actorGrupe", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity=SendOfferGrupe::class, mappedBy="Grupe")
     */
    private $sendOfferGrupes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function __construct(
        User $user,
        string $Name,
        string $Adres,
        int $Phone,
        string $description
    )
    {
        $this->User = $user;
        $this->Name = $Name;
        $this->Adres = $Adres;
        $this->Phone = $Phone;
        $this->description = $description;
        $this->sendOfferGrupes = new ArrayCollection();
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
            $sendOfferGrupe->setGrupe($this);
        }

        return $this;
    }

    public function removeSendOfferGrupe(SendOfferGrupe $sendOfferGrupe): self
    {
        if ($this->sendOfferGrupes->contains($sendOfferGrupe)) {
            $this->sendOfferGrupes->removeElement($sendOfferGrupe);
            // set the owning side to null (unless already changed)
            if ($sendOfferGrupe->getGrupe() === $this) {
                $sendOfferGrupe->setGrupe(null);
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
