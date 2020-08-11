<?php

namespace App\Entity\User\User\UseCase;

use App\Adapter\Core\EmailFactory;
use App\Entity\User\User;
use App\Adapter\Core\Transaction;
use App\Adapter\User\Users;
use App\Entity\User\User\UseCase\ActivateUser\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGenerator;

class ActivateUser extends AbstractController
{
    private $users;
    private $transaction;
    private $entityManager;
    private $emailFactory;
    private $mailer;

    public function __construct(
        Users $users,
        Transaction $transaction,
        EntityManagerInterface $entityManager,
        EmailFactory $emailFactory,
        \Swift_Mailer $mailer
    ){
        $this->users = $users;
        $this->transaction = $transaction;
        $this->entityManager = $entityManager;
        $this->emailFactory = $emailFactory;
        $this->mailer = $mailer;
    }

    public function execute(
        Command $command
    ){
        $this->transaction->begin();

        $user = $command->getUser();
        $user->activateUser(
            $command->getToken(),
            $command->getTokenExpire(),
            $command->getIsActive(),
            $command->getHeight(),
            $command->getEyes(),
            $command->getHair(),
            $command->getWeight(),
            $command->getGender()
        );

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        $command->getResponder()->ActivateUser($user);
    }
}