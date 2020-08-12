<?php


namespace App\Entity\CandidateProfil\UseCase;


use App\Adapter\Candidate\Candidate;
use App\Adapter\Core\Transaction;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile\Command;

class CreateCandidateProfile
{

    /**
     * @var Candidate
     */
    private $candidate;
    /**
     * @var Transaction
     */
    private $transaction;

    public function __construct(Candidate $candidate, Transaction $transaction)
    {

        $this->candidate = $candidate;
        $this->transaction = $transaction;
    }
    public function execute(Command $command){
        $this->transaction->begin();
        $Candidate=new CandidateProfil(
            $command->getUser()
        );

        $this->candidate->add($Candidate);
        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }
    }

}