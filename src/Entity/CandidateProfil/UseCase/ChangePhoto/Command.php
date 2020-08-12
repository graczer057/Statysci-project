<?php


namespace App\Entity\CandidateProfil\UseCase\ChangePhoto;


use App\Entity\User\User;

class Command
{

    /**
     * @var User
     */
    private $user;
    /**
     * @var string
     */
    private $photo;

    public function __construct(
        User $user,
        string $photo
    )
    {
        $this->user = $user;
        $this->photo = $photo;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

}