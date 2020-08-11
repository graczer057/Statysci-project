<?php

namespace App\Entity\User\User\UseCase\CreateUser;

use App\Entity\User\User;

interface Responder
{
    public function CreateUser(User $user);
    public function emailExists();
}