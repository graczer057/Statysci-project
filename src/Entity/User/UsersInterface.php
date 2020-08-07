<?php

namespace App\Entity\User;

interface UsersInterface
{
    public function add(User $user);
    public function findByToken(string $token);
    public function findByEmail(string $email);
}