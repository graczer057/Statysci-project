<?php

namespace App\Entity\User\User\UseCase\ExpireUser;

use App\Entity\User\User;

interface Responder
{
    public function UserTokenExpire(User $user);
}