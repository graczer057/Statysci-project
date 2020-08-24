<?php


namespace App\Adapter\Offers;


use App\Entity\Offers\OffersInterface;
use Doctrine\ORM\EntityManagerInterface;

class Offers implements OffersInterface
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
    
    public function add(\App\Entity\Offers\Offers $offers)
    {
        $this->manager->persist($offers);
    }

}