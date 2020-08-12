<?php

namespace App\Entity\ActorGrupe\UseCase\CreateActorGroup;

use App\Entity\ActorGrupe\ActorGrupe;

interface Responder
{
    public function createGroup(ActorGrupe $actorGrupe);
    public function linkExpired();
}