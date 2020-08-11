<?php

namespace App\Entity\User\User\ReadModel;

interface UsersQueryInterface
{
    public function getByToken(string $token);
    public function getByEmail(string $email);
}