<?php

namespace App\Entity\Business\UseCase;

use App\Adapter\BusinessGroupe\BusinessGroup;
use App\Adapter\Core\EmailFactory;
use App\Adapter\Core\Transaction;
use App\Adapter\User\Users;
use App\Entity\Business\Business;
use App\Entity\Business\UseCase\CreateBuisness\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateBuisness extends AbstractController
{
    private $businessGroup;
    private $users;
    private $transaction;
    private $emailFactory;
    private $mailer;

    public function __construct(
        BusinessGroup $businessGroup,
        Users $users,
        Transaction $transaction,
        EmailFactory $emailFactory,
        \Swift_Mailer $mailer
    ){
        $this->businessGroup = $businessGroup;
        $this->users = $users;
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->mailer = $mailer;
    }

    public function execute(
        Command $command
    ){
        $this->transaction->begin();

        $user = $this->users->findByToken($command->getToken());
        $user->activateUser();

        $business = new Business(
            $user,
            $command->getName(),
            $command->getNip(),
            $command->getAdres(),
            $command->getPhone(),
            $command->getDescription()
        );

        $this->businessGroup->add($business);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        $template = $this->render("Mail/Activate.html.twig");
        $this->createNotFoundException();
        $template = str_replace("$.name.$", $user->getLogin(), $template);
        $swiftMessage = $this->emailFactory->create(
            'Pomyślna aktywacja',
            nl2br($template),
            [
                $user->getEmail()
            ]
        );
        $this->mailer->send($swiftMessage);

        $command->getResponder()->createBusiness($business);
    }

}