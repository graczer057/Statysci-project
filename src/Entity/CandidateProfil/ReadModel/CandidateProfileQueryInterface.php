<?php

namespace App\Entity\CandidateProfil\ReadModel;

use App\Entity\User\User;

interface CandidateProfileQueryInterface
{
    public function getById(int $id);
    public function getByUser(User $user);
}