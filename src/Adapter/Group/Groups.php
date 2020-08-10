<?php

namespace App\Adapter\Group;

use App\Entity\Groups\Group;
use App\Entity\Groups\GroupsInterface;
use Doctrine\Persistence\ObjectManager;

class Groups implements GroupsInterface
{
    private $manager;

    public function __construct(
        ObjectManager $manager
    ){
        $this->manager = $manager;
    }

    public function add(Group $group)
    {
        $this->manager->persist($group);
    }

    public function findByToken(string $token)
    {
        return $this->manager->getRepository(Group::class)->findOneBy(['token' => $token]);
    }

    public function findByEmail(string $email)
    {
        return $this->manager->getRepository(Group::class)->findOneBy(['email' => $email]);
    }
}