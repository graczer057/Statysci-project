<?php


namespace App\Entity\CandidateProfil\UseCase;


use App\Adapter\Candidate\Candidate;
use App\Adapter\Core\Transaction;
use App\Entity\CandidateProfil\UseCase\EditCandidate\Command;

class EditCandidate
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


    public function execute(Command $command)
    {
        $this->transaction->begin();
        $Candidate=$command->getCandidateProfil();
        $Candidate->edit(
            $command->getGrowth(),
            $command->getPhysique(),
            $command->getHairLength(),
            $command->getHairColor(),
            $command->getEyeColor(),
            $command->getAge(),
            $command->getSex(),
            $command->getIsShow()
        );
        try{
            $this->transaction->commit();
        } catch (\Throwable $e){
            $this->transaction->rollback();
            throw $e;
        }
    }
}