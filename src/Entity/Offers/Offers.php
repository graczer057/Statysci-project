<?php

namespace App\Entity\Offers;

use App\Entity\CandidateApplication\CandidatApplication;
use App\Entity\User\User;
use App\Repository\Offers\OffersRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffersRepository::class)
 */
class Offers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="offers")
     */
    private $IdUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Physique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $HairLength;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $HairColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EyeColor;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $GrowthMin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $GrowthMax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $AgeMax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $AgeMin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateAdd;

    /**
     * @ORM\OneToMany(targetEntity=CandidatApplication::class, mappedBy="Offer")
     */
    private $candidatApplications;

    public function __construct(

        User $IdUser,
        string $Title,
        string $Description,
        string $Physique,
        string $HairLength,
        string $HairColor,
        string $EyeColor,
        string $sex,
        ?int $GrowthMin,
        ?int $GrowthMax,
        ?int $AgeMax,
        ?int $AgeMin,
        bool $isActive=true
    )
    {
        $this->IdUser = $IdUser;
        $this->Title = $Title;
        $this->Description = $Description;
        $this->Physique = $Physique;
        $this->HairLength = $HairLength;
        $this->HairColor = $HairColor;
        $this->EyeColor = $EyeColor;
        $this->sex = $sex;
        $this->GrowthMin = $GrowthMin;
        $this->GrowthMax = $GrowthMax;
        $this->AgeMax = $AgeMax;
        $this->AgeMin = $AgeMin;
        $this->isActive = $isActive;
        $this->DateAdd=new DateTime('now');
        $this->candidatApplications = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getIdUser(): User
    {
        return $this->IdUser;
    }

    public function addIdUser(User $idUser): self
    {
        if (!$this->IdUser->contains($idUser)) {
            $this->IdUser[] = $idUser;
            $idUser->setOffers($this);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        if ($this->IdUser->contains($idUser)) {
            $this->IdUser->removeElement($idUser);
            // set the owning side to null (unless already changed)
            if ($idUser->getOffers() === $this) {
                $idUser->setOffers(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPhysique(): ?string
    {
        return $this->Physique;
    }

    public function setPhysique(string $Physique): self
    {
        $this->Physique = $Physique;

        return $this;
    }

    public function getHairLength(): ?string
    {
        return $this->HairLength;
    }

    public function setHairLength(string $HairLength): self
    {
        $this->HairLength = $HairLength;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->HairColor;
    }

    public function setHairColor(string $HairColor): self
    {
        $this->HairColor = $HairColor;

        return $this;
    }

    public function getEyeColor(): ?string
    {
        return $this->EyeColor;
    }

    public function setEyeColor(string $EyeColor): self
    {
        $this->EyeColor = $EyeColor;

        return $this;
    }


    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getGrowthMin(): ?int
    {
        return $this->GrowthMin;
    }

    public function setGrowthMin(int $GrowthMin): self
    {
        $this->GrowthMin = $GrowthMin;

        return $this;
    }

    public function getGrowthMax(): ?int
    {
        return $this->GrowthMax;
    }

    public function setGrowthMax(int $GrowthMax): self
    {
        $this->GrowthMax = $GrowthMax;

        return $this;
    }

    public function getAgeMax(): ?int
    {
        return $this->AgeMax;
    }

    public function setAgeMax(int $AgeMax): self
    {
        $this->AgeMax = $AgeMax;

        return $this;
    }

    public function getAgeMin(): ?int
    {
        return $this->AgeMin;
    }

    public function setAgeMin(int $AgeMin): self
    {
        $this->AgeMin = $AgeMin;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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

    /**
     * @return Collection|CandidatApplication[]
     */
    public function getCandidatApplications(): Collection
    {
        return $this->candidatApplications;
    }

    public function addCandidatApplication(CandidatApplication $candidatApplication): self
    {
        if (!$this->candidatApplications->contains($candidatApplication)) {
            $this->candidatApplications[] = $candidatApplication;
            $candidatApplication->setOffer($this);
        }

        return $this;
    }

    public function removeCandidatApplication(CandidatApplication $candidatApplication): self
    {
        if ($this->candidatApplications->contains($candidatApplication)) {
            $this->candidatApplications->removeElement($candidatApplication);
            // set the owning side to null (unless already changed)
            if ($candidatApplication->getOffer() === $this) {
                $candidatApplication->setOffer(null);
            }
        }

        return $this;
    }
}
