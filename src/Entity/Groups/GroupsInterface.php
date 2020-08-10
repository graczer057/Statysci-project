<?php

namespace App\Entity\Groups;

use App\Entity\Groups;

Interface GroupsInterface
{
    public function add(Groups $groups);
    public function findByToken(string $token);
    public function findByEmail(string $email);
}