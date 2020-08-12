<?php

namespace App\Entity\Business\ReadModel;

use App\Entity\User\User;

interface BusinessQueryInterface
{
    public function getById(int $id);
    public function getByUser(User $user);
}