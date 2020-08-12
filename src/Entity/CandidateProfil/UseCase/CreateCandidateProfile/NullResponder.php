<?php

namespace App\Entity\CandidateProfil\UseCase\CreateCandidateProfile;

use App\Entity\CandidateProfil\CandidateProfil;

class NullResponder implements Responder
{
    public function createCandidate(CandidateProfil $candidate)
    {
        // TODO: Implement createCandidate() method.
    }

    public function linkExpired()
    {
        // TODO: Implement linkExpired() method.
    }
}