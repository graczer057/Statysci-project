<?php

namespace App\Entity\User\User\UseCase;

use App\Adapter\User\Users;
use App\Entity\User\User;
use App\Adapter\Core\Transaction;
use App\Entity\User\User\UseCase\ExpireUser\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGenerator;
use App\Adapter\Core\EmailFactory;
use Doctrine\ORM\EntityManagerInterface;

class ExpireUser extends AbstractController
{
    private $users;
    private $transaction;
    private $emailFactory;
    private $mailer;
    private $entityManager;

    public function __construct(
        Users $users,
        Transaction $transaction,
        EmailFactory $emailFactory,
        \Swift_Mailer $mailer,
        EntityManagerInterface $entityManager
    ){
        $this->users = $users;
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
    }

    public function candidate(
        Command $command
    ){
        $this->transaction->begin();

        $user = $this->users->findByToken($command->getToken());
        $user->TokenExpire(
            $command->getToken(),
            $command->getTokenExpire()
        );

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $command->getUser()->getEmail()]);

        $template = $this->renderView("mail/Register.html.twig");

        $this->createNotFoundException();

        $url = $this->generateUrl('candidate_activate', array('token' => $user->getToken()), UrlGenerator::ABSOLUTE_URL);

        $template = str_replace("$.name.$", $command->getUser()->getLogin(), $template);
        $template = str_replace("$.LINK.$", '<a href="' . $url . '" target="_blank">aktywuj konto</a>', $template);

        $swiftMessage = $this->emailFactory->create(
            'Nowy link',
            nl2br($template),
            [
                $command->getUser()->getEmail()
            ]
        );

        $this->mailer->send($swiftMessage);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        $command->getResponder()->UserTokenExpire($user);
    }

    public function Business(
        Command $command
    ){
        $this->transaction->begin();

        $user = $this->users->findByToken($command->getToken());
        $user->TokenExpire(
            $command->getToken(),
            $command->getTokenExpire()
        );

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $command->getUser()->getEmail()]);

        $template = $this->renderView("mail/Register.html.twig");

        $this->createNotFoundException();

        $url = $this->generateUrl('business_activate', array('token' => $user->getToken()), UrlGenerator::ABSOLUTE_URL);

        $template = str_replace("$.name.$", $command->getUser()->getLogin(), $template);
        $template = str_replace("$.LINK.$", '<a href="' . $url . '" target="_blank">aktywuj konto</a>', $template);

        $swiftMessage = $this->emailFactory->create(
            'Nowy link',
            nl2br($template),
            [
                $command->getUser()->getEmail()
            ]
        );

        $this->mailer->send($swiftMessage);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        $command->getResponder()->UserTokenExpire($user);
    }

    public function Group(
        Command $command
    ){
        $this->transaction->begin();

        $user = $this->users->findByToken($command->getUser()->getToken());

        $user->TokenExpire(
            $command->getToken(),
            $command->getTokenExpire()
        );

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $command->getUser()->getEmail()]);

        $template = $this->renderView("mail/Register.html.twig");

        $this->createNotFoundException();

        $url = $this->generateUrl('actor_activate', array('token' => $user->getToken()), UrlGenerator::ABSOLUTE_URL);

        $template = str_replace("$.name.$", $command->getUser()->getLogin(), $template);
        $template = str_replace("$.LINK.$", '<a href="' . $url . '" target="_blank">aktywuj konto</a>', $template);

        $swiftMessage = $this->emailFactory->create(
            'Nowy link',
            nl2br($template),
            [
                $command->getUser()->getEmail()
            ]
        );

        $this->mailer->send($swiftMessage);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        $command->getResponder()->UserTokenExpire($user);
    }
}