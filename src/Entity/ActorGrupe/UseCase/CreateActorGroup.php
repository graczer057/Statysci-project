<?php

namespace App\Entity\ActorGrupe\UseCase;

use App\Adapter\Group\Groups;
use App\Adapter\Core\EmailFactory;
use App\Adapter\Core\Transaction;
use App\Adapter\User\Users;
use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\ActorGrupe\UseCase\CreateActorGroup\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateActorGroup extends AbstractController
{
    private $Groups;
    private $users;
    private $transaction;
    private $emailFactory;
    private $mailer;

    public function __construct(
        Groups $groups,
        Users $users,
        Transaction $transaction,
        EmailFactory $emailFactory,
        \Swift_Mailer $mailer
    ){
        $this->groups = $groups;
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

        $business = new ActorGrupe(
            $user,
            $command->getName(),
            $command->getAdres(),
            $command->getPhone(),
            $command->getDescription()
        );

        $this->Groups->add($business);

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

        $command->getResponder()->createGroup($business);
    }
}