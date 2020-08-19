<?php


namespace App\Adapter\SendOfferGroup;


use App\Entity\SendOfferGrupe\SendOfferGroupeInterface;
use App\Entity\SendOfferGrupe\SendOfferGrupe;
use Doctrine\ORM\EntityManagerInterface;

class SendOfferGroup implements SendOfferGroupeInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(
        EntityManagerInterface $manager
    )
    {
        $this->manager = $manager;
    }

    public function add(SendOfferGrupe $sendOfferGrupe)
    {
        $this->manager->persist($sendOfferGrupe);
    }
    public function LoadAllByIdGroup(int $idGroup)
    {
     return $this->manager->getRepository(SendOfferGrupe::class)->findBy(['Grupe'=>$idGroup]);
    }

}