<?php


namespace App\Adapter\SendOfferBusiness;


use App\Entity\SendOfferBusiness\SendOfferBuisnessInterface;
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
}