<?php

namespace App\Entity\CandidateProfil;

use App\Entity\User\User;

interface CandidateProfilesInterface
{
    public function add(CandidateProfil $candidate);
    public function findByUser(User $user);
}