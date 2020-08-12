<?php


namespace App\Entity\CandidateProfil\UseCase;



use App\Adapter\Core\Transaction;
use App\Adapter\User\Users;
use App\Entity\CandidateProfil\UseCase\ChangePhoto\Command;

class ChangePhoto
{
    /**
     * @var Users
     */
    private $users;
    /**
     * @var Transaction
     */
    private $transaction;

    public function __construct(Users $users, Transaction $transaction)
    {
        $this->users = $users;
        $this->transaction = $transaction;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();
        $User=$command->getUser();
        $User->ChangePhoto(
            $command->getPhoto()
        );

        try{
            $this->transaction->commit();
        } catch (\Throwable $e){
            $this->transaction->rollback();
            throw $e;
        }
    }

}