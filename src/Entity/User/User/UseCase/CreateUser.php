<?php

namespace App\Entity\User\User\UseCase;

use App\Adapter\Core\EmailFactory;
use App\Entity\User\User;
use App\Adapter\Core\Transaction;
use App\Adapter\User\Users;
use App\Entity\User\User\UseCase\CreateUser\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGenerator;

class CreateUser extends AbstractController
{
    private $users;
    private $transaction;
    private $entityManager;
    private $emailFactory;
    private $mailer;

    public function __construct(
        Users $users,
        Transaction $transaction,
        EmailFactory $emailFactory,
        EntityManagerInterface $entityManager,
        \Swift_Mailer $mailer
    ){
        $this->users = $users;
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    public function execute(
        Command $command
    )
    {
        $this->transaction->begin();



        if($this->users->findByEmail($command->getEmail())){
            $command->getResponder()->emailExists();
            return $this->redirectToRoute('homepage');
        }
        $user = new User(
            $command->getLogin(),
            $command->getEmail(),
            $command->getPassword(),
            $command->getRoles()
        );

        $this->users->add($user);

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

        $command->getResponder()->CreateUser($user);


    }
}