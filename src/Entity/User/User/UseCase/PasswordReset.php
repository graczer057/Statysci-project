<?php


namespace App\Entity\User\User\UseCase;


use App\Adapter\Core\EmailFactory;
use App\Adapter\Core\Transaction;
use App\Adapter\User\Users;
use App\Entity\User\User\UseCase\PasswordReset\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGenerator;

class PasswordReset extends AbstractController
{

    private $transaction;
    private $emailFactory;
    private $mailer;


    public function __construct(Users $users, Transaction $transaction,
                                EmailFactory $emailFactory,
                                EntityManagerInterface $entityManager,
                                \Swift_Mailer $mailer )
    {
        $this->users = $users;
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();

        $User = $command->getUser();

        $User->TokenExpire(
            $command->getToken(),
            $command->getTokenExpire()
        );

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        $template = $this->renderView("User/email/PasswordReset.html.twig");
        $this->createNotFoundException();
        $url = $this->generateUrl('app_password_change', array('token' => $command->getToken()), UrlGenerator::ABSOLUTE_URL);
        $template = str_replace("$.name.$", $User->getUsername(), $template);
        $template = str_replace("$.LINK.$", '<a href="' . $url . '" target="_blank">zmień <hasło></hasło></a>', $template);
        $swiftMessage = $this->emailFactory->create(
            'Nowy Link',
            nl2br($template),
            [
                $User->getEmail()
            ]
        );
        $this->mailer->send($swiftMessage);

        $command->getResponder()->passwordreset($User);
    }
}