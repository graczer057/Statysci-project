<?php

namespace App\Entity\Groups\ReadModel;

interface GroupsQueryInterface
{
    public function getByToken(string $token);
    public function getByEmail(string $email);
}