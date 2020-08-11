<?php


namespace App\Entity\Business\UseCase\CreateBuisness;


use App\Entity\SendOfferBusiness\SendOfferBusiness;
use App\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Command
{

    private $Name;
    private $NIP;
    private $Adres;
    private $Phone;
    private $User;
    private $sendOfferBusinesses;
    private $description;





    public function getName(): ?string
    {
        return $this->Name;
    }


    public function getNIP(): ?int
    {
        return $this->NIP;
    }

    public function getAdres(): ?string
    {
        return $this->Adres;
    }



    public function getPhone(): ?int
    {
        return $this->Phone;
    }


    public function getUser(): ?User
    {
        return $this->User;
    }

    public function getSendOfferBusinesses(): Collection
    {
        return $this->sendOfferBusinesses;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }


}