<?php

namespace App\Entity\CandidateProfil\UseCase\CreateCandidateProfile;

use App\Entity\CandidateProfil\CandidateProfil;

interface Responder
{
    public function createCandidate(CandidateProfil $candidate);
    public function linkExpired();
}