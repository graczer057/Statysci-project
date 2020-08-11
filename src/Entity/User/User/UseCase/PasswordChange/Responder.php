<?php


namespace App\Entity\User\User\UseCase\PasswordChange;


use App\Entity\User\User;

interface Responder
{

    public function PasswordChange();
    public function LostToken();
}