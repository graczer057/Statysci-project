<?php


namespace App\Entity\CandidateProfil\UseCase\EditCandidate;


use App\Entity\CandidateProfil\CandidateProfil;

class Command
{
    /**
     * @var CandidateProfil
     */
    private $candidateProfil;
    /**
     * @var int
     */
    private $Growth;
    /**
     * @var string
     */
    private $physique;
    /**
     * @var string
     */
    private $Hair_Length;
    /**
     * @var string
     */
    private $Hair_Color;
    /**
     * @var string
     */
    private $Eye_Color;
    /**
     * @var int
     */
    private $Age;
    private $Responder;
    /**
     * @var string|null
     */
    private $sex;


    public function __construct(
    CandidateProfil $candidateProfil,
    ?int $Growth,
    ?string $physique,
    ?string $Hair_Length,
    ?string $Hair_Color,
    ?string $Eye_Color,
    ?int $Age,
    ?string $sex
)
{
    $this->candidateProfil = $candidateProfil;
    $this->Growth = $Growth;
    $this->physique = $physique;
    $this->Hair_Length = $Hair_Length;
    $this->Hair_Color = $Hair_Color;
    $this->Eye_Color = $Eye_Color;
    $this->Age = $Age;
    $this->Responder=new NullResponder();
    $this->sex = $sex;
}

    /**
     * @return CandidateProfil
     */
    public function getCandidateProfil(): CandidateProfil
    {
        return $this->candidateProfil;
    }

    /**
     * @return int
     */
    public function getGrowth(): int
    {
        return $this->Growth;
    }

    /**
     * @return string
     */
    public function getPhysique(): string
    {
        return $this->physique;
    }


    /**
     * @return string
     */
    public function getHairLength(): string
    {
        return $this->Hair_Length;
    }

    /**
     * @return string
     */
    public function getHairColor(): string
    {
        return $this->Hair_Color;
    }

    /**
     * @return string
     */
    public function getEyeColor(): string
    {
        return $this->Eye_Color;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->Age;
    }

    /**
     * @return NullResponder
     */
    public function getResponder(): NullResponder
    {
        return $this->Responder;
    }

    /**
     * @param NullResponder $Responder
     */
    public function setResponder(NullResponder $Responder): void
    {
        $this->Responder = $Responder;
    }

    /**
     * @return string|null
     */
    public function getSex(): ?string
    {
        return $this->sex;
    }
}