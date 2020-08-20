<?php

namespace App\Entity\CandidateProfil\ReadModel;

use App\Entity\User\User;

interface CandidateProfileQueryInterface
{
    public function getById(int $id);
    public function getByUser(User $user);
    public function getfilter(int $growthmin,int $growthmax,string $physique,string $hairLength,string $hairColor,string $eyeColor, int $agemin, int $agemax,string $sex);
}