<?php

namespace App\Entity\CandidateApplication\CandidateApplication\UseCase;

use App\Adapter\CandidatApplication\CandidatApplication;
use App\Adapter\Core\EmailFactory;
use App\Adapter\Core\Transaction;
use App\Entity\CandidateApplication\CandidateApplication\UseCase\CreateCandidateApplication\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateCandidateApplication extends AbstractController
{
    private $candidatApplication;
    private $transaction;
    private $emailFactory;
    private $mailer;

    public function __construct(
        CandidatApplication $candidatApplication,
        Transaction $transaction,
        EmailFactory $emailFactory,
        \Swift_Mailer $mailer
    )
    {
        $this->candidatApplication = $candidatApplication;
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->mailer = $mailer;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();

        $Application = new \App\Entity\CandidateApplication\CandidatApplication(
            $command->getOffer(),
            $command->getCandidate(),
            $command->getStatus());
        $this->candidatApplication->add($Application);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }

        $template = $this->renderView("mail/SendApplication.html.twig");

        $this->createNotFoundException();

        $swiftMessage = $this->emailFactory->create(
            'Nowa oferta współpracy',
            nl2br($template),
            [
                $command->getOffer()->getIdUser()
            ]
        );
        $this->mailer->send($swiftMessage);
    }
}