<?php

namespace App\Entity\Groups\UseCase;

use App\Adapter\Core\EmailFactory;
use App\Entity\Groups\Group;
use App\Adapter\Core\Transaction;
use App\Adapter\Group\Groups;
use App\Entity\Groups\UseCase\CreateGroup\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateGroup extends AbstractController
{
    private $groups;
    private $transaction;
    private $entityManager;
    private $emailFactory;
    private $mailer;

    public function __construct(
        Groups $groups,
        Transaction $transaction,
        EntityManagerInterface $entityManager,
        EmailFactory $emailFactory,
        \Swift_Mailer $mailer
    ){
        $this->groups = $groups;
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    public function execute(
        Command $command
    ){
        $this->transaction->begin();

        $group = new Group(
            $command->getName(),
            $command->getEmail(),
            $command->getNip(),
            $command->getPassword(),
            $command->getDescription(),
            $command->getRoles()
        );

        $this->groups->add($group);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email'=>$command->getEmail()]);
        $template = $this->renderView("mail/Register.html.twig");
        $this->createNotFoundException();
        $url = $this->generateUrl('activate', array('token'=>$user->getToken()), UrlGenerator::ABSOLUTE_URL);
        $template = str_replace("$.name.$", $command->getLogin(), $template);
        $template = str_replace("$.LINK.$", '<a href="'.$url.'" target="_blank">aktywuj konto</a>', $template);
        $swiftMessage = $this->emailFactory->create(
            'Pomyślna rejestracja',
            nl2br($template),
            [
                $command->getEmail()
            ]
        );
        $this->mailer->send($swiftMessage);


        $command->getResponder()->CreateGroup($group);
    }
}