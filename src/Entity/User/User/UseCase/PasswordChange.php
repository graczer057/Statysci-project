<?php


namespace App\Entity\User\User\UseCase;


use App\Adapter\Core\EmailFactory;
use App\Adapter\Core\Transaction;
use App\Adapter\User\Users;
use App\Entity\User\User\UseCase\PasswordChange\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGenerator;

class PasswordChange extends AbstractController
{

    private $transaction;
    private $emailFactory;
    private $mailer;
    private $Users;


    public function __construct(Users $users, Transaction $transaction,
                                EmailFactory $emailFactory,
                                EntityManagerInterface $entityManager,
                                \Swift_Mailer $mailer )
    {
        $this->Users = $users;
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();
        $date = new \DateTime("now");

        $User = $command->getUser();
        if($this->Users->findbyToken($User->getToken())->getTokenExpire()->getTimestamp()<$date->getTimestamp()){
            $command->getResponder()->LostToken();
            return;
        }
        $User->PasswordChange(
            $command->getPassword(),
            $command->getToken(),
            $command->getTokenExpire()
        );

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        $template = $this->renderView("mail/PasswordChange.html.twig");
        $this->createNotFoundException();
        $template = str_replace("$.name.$", $User->getUsername(), $template);
        $swiftMessage = $this->emailFactory->create(
            'Nowy Link',
            nl2br($template),
            [
                $User->getEmail()
            ]
        );
        $this->mailer->send($swiftMessage);

        $command->getResponder()->PasswordChange();
    }
}