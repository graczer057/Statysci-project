<?php


namespace App\Entity\CandidateApplication\CandidateApplication\UseCase;


use App\Adapter\CandidatApplication\CandidatApplication;
use App\Adapter\Core\Transaction;
use App\Entity\CandidateApplication\CandidateApplication\UseCase\CreateCandidateApplication\Command;

class CreateCandidateApplication
{
    /**
     * @var CandidatApplication
     */
    private $candidatApplication;
    /**
     * @var Transaction
     */
    private $transaction;

    public function __construct(
        CandidatApplication $candidatApplication,
        Transaction $transaction
    )
    {
        $this->candidatApplication = $candidatApplication;
        $this->transaction = $transaction;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();
        $Application = new \App\Entity\CandidateApplication\CandidatApplication(
            $command->getOffer(),
            $command->getCandidate(),
            $command->getStatus());
        $this->candidatApplication->add($Application);
        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }
        $command->getResponder()->CreateCandidateApplication();
    }
}