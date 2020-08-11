<?php


namespace App\Entity\ActorGrupe\ReadModel;


use App\Entity\User\User;

interface ActorGroupsQueryInterface
{
    public function getById(int $id);
    public function getByUser(User $user);
}