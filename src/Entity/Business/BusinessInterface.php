<?php

namespace App\Entity\Business;

use App\Entity\User\User;

Interface BusinessInterface
{
    public function add(Business $business);
    public function findByUser(User $user);
}