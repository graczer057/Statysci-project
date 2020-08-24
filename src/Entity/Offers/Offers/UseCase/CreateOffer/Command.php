<?php


namespace App\Entity\Offers\Offers\UseCase\CreateOffer;


use App\Entity\User\User;

class Command
{

    /**
     * @var User
     */
    private $IdUser;
    /**
     * @var string
     */
    private $Title;
    /**
     * @var string
     */
    private $Description;
    /**
     * @var string
     */
    private $Physoqie;
    /**
     * @var string
     */
    private $HairLength;
    /**
     * @var string
     */
    private $HairColor;
    /**
     * @var string
     */
    private $EyeColor;
    /**
     * @var string
     */
    private $Sex;
    /**
     * @var int|null
     */
    private $GrowthMin;
    /**
     * @var int|null
     */
    private $GrowthMax;
    /**
     * @var int|null
     */
    private $AgeMax;
    /**
     * @var int|null
     */
    private $AgeMin;
    private $responder;


    public function __construct(
        User $IdUser,
        string $Title,
        string $Description,
        string $Physoqie,
        string $HairLength,
        string $HairColor,
        string $EyeColor,
        string $Sex,
        ?int $GrowthMin,
    ?int $GrowthMax,
    ?int $AgeMax,
    ?int $AgeMin
)
    {
        $this->IdUser = $IdUser;
        $this->Title = $Title;
        $this->Description = $Description;
        $this->Physoqie = $Physoqie;
        $this->HairLength = $HairLength;
        $this->HairColor = $HairColor;
        $this->EyeColor = $EyeColor;
        $this->Sex = $Sex;
        $this->GrowthMin = $GrowthMin;
        $this->GrowthMax = $GrowthMax;
        $this->AgeMax = $AgeMax;
        $this->AgeMin = $AgeMin;
        $this->responder = new NullResponder();

    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->Title;
    }

    /**
     * @return User
     */
    public function getIdUser(): User
    {
        return $this->IdUser;
    }

    /**
     * @return int|null
     */
    public function getGrowthMin(): ?int
    {
        return $this->GrowthMin;
    }

    /**
     * @return int|null
     */
    public function getGrowthMax(): ?int
    {
        return $this->GrowthMax;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->Description;
    }

    /**
     * @return int|null
     */
    public function getAgeMin(): ?int
    {
        return $this->AgeMin;
    }

    /**
     * @return int|null
     */
    public function getAgeMax(): ?int
    {
        return $this->AgeMax;
    }

    /**
     * @return string
     */
    public function getHairLength(): string
    {
        return $this->HairLength;
    }

    /**
     * @return string
     */
    public function getHairColor(): string
    {
        return $this->HairColor;
    }

    /**
     * @return string
     */
    public function getEyeColor(): string
    {
        return $this->EyeColor;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->Sex;
    }

    /**
     * @return string
     */
    public function getPhysoqie(): string
    {
        return $this->Physoqie;
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