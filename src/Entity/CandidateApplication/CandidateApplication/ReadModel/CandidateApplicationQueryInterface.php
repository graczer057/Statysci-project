<?php


namespace App\Entity\CandidateApplication\CandidateApplication\ReadModel;


interface CandidateApplicationQueryInterface
{
public function findApplication(int $idOffer);
}