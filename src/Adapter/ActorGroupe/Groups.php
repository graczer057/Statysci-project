<?php

namespace App\Adapter\ActorGroupe;

use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\ActorGrupe\GroupInterface;
use App\Entity\User\User;
use Doctrine\Persistence\ObjectManager;

class Groups implements GroupInterface
{
    private $manager;

    public function __construct(
        ObjectManager $manager
    ){
        $this->manager = $manager;
    }

    public function add(ActorGrupe $actorGrupe)
    {
        $this->manager->persist($actorGrupe);
    }
    public function findByUser(User $user)
    {
        return $this->manager->getRepository(ActorGrupe::class)->findOneBy(['user' => $user]);
    }
}