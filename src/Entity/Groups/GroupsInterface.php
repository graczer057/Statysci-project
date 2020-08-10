<?php

namespace App\Entity\Groups;

Interface GroupsInterface
{
    public function add(Group $groups);
    public function findByToken(string $token);
    public function findByEmail(string $email);
}