<?php

namespace App\Adapter\BusinessGroupe;

use App\Entity\Business\Business;
use App\Entity\Business\BusinessInterface;
use App\Entity\User\User;
use Doctrine\Persistence\ObjectManager;

class BusinessGroup implements BusinessInterface
{
    private $manager;

    public function __construct(
        ObjectManager $manager
    ){
        $this->manager = $manager;
    }

    public function add(Business $business)
    {
        $this->manager->persist($business);
    }

    public function findByUser(User $user)
    {
        return $this->manager->getRepository(Business::class)->findOneBy(['user' => $user]);
    }
}