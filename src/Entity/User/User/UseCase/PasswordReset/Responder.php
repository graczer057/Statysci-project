<?php


namespace App\Entity\User\User\UseCase\PasswordReset;


use App\Entity\User\User;

interface Responder
{
    public function passwordreset(User $user);

}