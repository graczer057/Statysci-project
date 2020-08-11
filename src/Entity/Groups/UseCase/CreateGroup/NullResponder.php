<?php

namespace App\Entity\Groups\UseCase\CreateGroup;

use App\Entity\Groups\Group;

class NullResponder implements Responder
{
    public function CreateGroup(Group $group)
    {
        // TODO: Implement CreateGroup() method.
    }

    public function NameOfGroupExists()
    {
        // TODO: Implement NameOfGroupExists() method.
    }
}