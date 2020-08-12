<?php

namespace App\Entity\ActorGrupe;

use App\Entity\User\User;

interface GroupInterface
{
    public function add(ActorGrupe $actorGrupe);
    public function findByUser(User $user);
}