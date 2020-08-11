<?php


namespace App\Entity\User\User\UseCase\ActivateUser;

use App\Entity\User\User;

interface Responder
{
    public function ActivateUser(User $user);
    public function linkExpired();
}