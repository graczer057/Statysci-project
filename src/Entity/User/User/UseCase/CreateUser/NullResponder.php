<?php

namespace App\Entity\User\User\UseCase\CreateUser;

use App\Entity\User\User;

class NullResponder implements Responder
{
    public function CreateUser(User $user)
    {
        // TODO: Implement CreateUser() method.
    }

    public function emailExists()
    {
        // TODO: Implement emailExists() method.
    }
}