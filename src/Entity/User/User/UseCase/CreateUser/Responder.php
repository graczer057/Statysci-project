<?php
/**
 * Created by PhpStorm.
 * User: patry
 * Date: 06.08.2020
 * Time: 15:47
 */

namespace App\Entity\User\User\UseCase\CreateUser;


use App\Entity\User\User;

interface Responder
{
    public function CreateUser(User $user);
    public function emailExists();
}