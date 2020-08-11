<?php

namespace App\Entity\User\User\UseCase\ActivateUser;

use App\Entity\User\User;

class NullResponder implements Responder
{
    public function ActivateUser(User $user)
    {
        // TODO: Implement ActivateUser() method.
    }

    public function linkExpired()
    {
        // TODO: Implement linkExpired() method.
    }
}