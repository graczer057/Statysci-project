<?php

namespace App\Entity\Groups;

Interface GroupsInterface
{
    public function add(Group $group);
    public function findByToken(string $token);
}