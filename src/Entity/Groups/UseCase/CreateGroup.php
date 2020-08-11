<?php

namespace App\Entity\Groups\UseCase;

use App\Adapter\Core\EmailFactory;
use App\Entity\Groups\Group;
use App\Adapter\Core\Transaction;
use App\Adapter\Group\Groups;
use App\Entity\Groups\UseCase\CreateGroup\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGenerator;

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
            $command->getRoles(),
            $command->getToken(),
            $command->getTokenExpire(),
            $command->getIsActive(),
            $command->getPhotoPath()
        );

        if($this->groups->findByName($command->getName())){
            $command->getResponder()->NameOfGroupExists();
            return $this->redirectToRoute('homepage');
        }

        $this->groups->add($group);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        $command->getResponder()->CreateGroup($group);
    }
}