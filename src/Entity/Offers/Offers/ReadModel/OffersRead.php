<?php


namespace App\Entity\Offers\Offers\ReadModel;


use App\Entity\User\User;

class OffersRead
{
    private $id;
    private $IdUser;
    private $Title;
    private $Description;
    private $Physique;
    private $HairLength;
    private $HairColor;
    private $EyeColor;
    private $sex;
    private $GrowthMin;
    private $GrowthMax;
    private $AgeMax;
    private $AgeMin;
    private $isActive;
    private $dateTime;

    public function __construct(
        int $id,
        $IdUser,
        string $Title,
        string $Description,
        string $Physique,
        string $HairLength,
        string $HairColor,
        string $EyeColor,
        string $sex,
        int $GrowthMin,
        int $GrowthMax,
        int $AgeMax,
        int $AgeMin,
        int $isActive,
        \DateTime $dateTime
    )
    {
        $this->id = $id;
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
        $this->dateTime = $dateTime;
    }


    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEyeColor()
    {
        return $this->EyeColor;
    }

    /**
     * @return mixed
     */
    public function getHairColor()
    {
        return $this->HairColor;
    }

    /**
     * @return mixed
     */
    public function getHairLength()
    {
        return $this->HairLength;
    }

    /**
     * @return mixed
     */
    public function getPhysique()
    {
        return $this->Physique;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @return mixed
     */
    public function getAgeMax()
    {
        return $this->AgeMax;
    }

    /**
     * @return mixed
     */
    public function getAgeMin()
    {
        return $this->AgeMin;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @return mixed
     */
    public function getGrowthMax()
    {
        return $this->GrowthMax;
    }

    /**
     * @return mixed
     */
    public function getGrowthMin()
    {
        return $this->GrowthMin;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->IdUser;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }
}