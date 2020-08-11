<?php

namespace App\Entity\Groups\UseCase\CreateGroup;

use App\Entity\Groups\Group;

interface Responder
{
    public function CreateGroup(Group $group);
    public function NameOfGroupExists();
}