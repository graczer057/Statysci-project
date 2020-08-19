<?php


namespace App\Adapter\SendOfferBusiness;


use App\Entity\SendOfferBusiness\SendOfferBuisnessInterface;
use App\Entity\SendOfferGrupe\SendOfferGrupe;
use Doctrine\ORM\EntityManagerInterface;

class SendOfferBusiness implements SendOfferBuisnessInterface
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

    public function add(\App\Entity\SendOfferBusiness\SendOfferBusiness $sendOfferBusiness)
    {
        $this->manager->persist($sendOfferBusiness);
    }
    public function LoadAllByIdBusiness(int $IdBusiness)
    {
        return $this->manager->getRepository(\App\Entity\SendOfferBusiness\SendOfferBusiness::class)->findBy(['Business'=> $IdBusiness]);
    }
}