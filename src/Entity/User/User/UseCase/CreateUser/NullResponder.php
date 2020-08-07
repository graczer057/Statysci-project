<?php
/**
 * Created by PhpStorm.
 * User: patry
 * Date: 06.08.2020
 * Time: 15:47
 */

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

    public function UserNameExists()
    {
        // TODO: Implement UserNameExists() method.
    }
}