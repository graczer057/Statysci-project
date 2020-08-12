<?php

namespace App\Adapter\User;

use App\Entity\User\User;
use App\Entity\User\UsersInterface;
use Doctrine\ORM\EntityManagerInterface;

class Users implements UsersInterface
{
    private $manager;

    public function __construct(
        EntityManagerInterface $manager
    ){
        $this->manager = $manager;
    }

    public function add(User $user)
    {
        $this->manager->persist($user);
    }

    public function findByToken(string $token)
    {
        return $this->manager->getRepository(User::class)->findOneBy(['token' => $token]);
    }

    public function findByEmail(string $email)
    {
        return $this->manager->getRepository(User::class)->findOneBy(['email' => $email]);
    }
}