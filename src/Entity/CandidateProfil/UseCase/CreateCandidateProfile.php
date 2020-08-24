<?php

namespace App\Entity\CandidateProfil\UseCase;

use App\Adapter\CandidateProfile\Candidates;
use App\Adapter\Core\EmailFactory;
use App\Adapter\Core\Transaction;
use App\Adapter\User\Users;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateCandidateProfile extends AbstractController
{
    private $candidates;
    private $users;
    private $transaction;
    private $emailFactory;
    private $mailer;

    public function __construct(
        Candidates $candidates,
        Users $users,
        Transaction $transaction,
        EmailFactory $emailFactory,
        \Swift_Mailer $mailer
    )
    {
        $this->candidates = $candidates;
        $this->users = $users;
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->mailer = $mailer;
    }

    public function execute(
        Command $command
    )
    {
        $this->transaction->begin();

        $user = $this->users->findByToken($command->getToken());
        $user->activateUser();

        $candidate = new CandidateProfil(
            $user,
            $command->getGrowth(),
            $command->getPhysique(),
            $command->getHairLength(),
            $command->getHairColor(),
            $command->getEyeColor(),
            $command->getAge(),
            $command->getSex(),
            $command->getFirstName(),
            $command->getSurname()
        );

        $this->candidates->add($candidate);

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

        $command->getResponder()->createCandidate($candidate);
    }
}