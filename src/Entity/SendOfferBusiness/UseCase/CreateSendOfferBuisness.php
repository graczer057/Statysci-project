<?php


namespace App\Entity\SendOfferBusiness\UseCase;

use App\Adapter\Candidate\Candidate;
use App\Adapter\Core\EmailFactory;
use App\Adapter\Core\Transaction;
use App\Entity\SendOfferBusiness\SendOfferBusiness;
use App\Entity\SendOfferBusiness\UseCase\CreateSendOfferBuisness\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGenerator;


class CreateSendOfferBuisness extends AbstractController
{

    /**
     * @var Transaction
     */
    private $transaction;
    /**
     * @var EmailFactory
     */
    private $emailFactory;
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var \App\Adapter\SendOfferBusiness\SendOfferBusiness
     */
    private $business;
    /**
     * @var Candidate
     */
    private $candidate;


    public function __construct(
        \App\Adapter\SendOfferBusiness\SendOfferBusiness $business,
        Transaction $transaction,
        EmailFactory $emailFactory,
        \Swift_Mailer $mailer
    )
    {
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->mailer = $mailer;
        $this->business = $business;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();

        $message= new SendOfferBusiness(
            $command->getBusiness(),
            $command->getCandidateProfil()
        );

        $this->business->add($message);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }


        $template = $this->renderView("mail/SendOfferBusiness.html.twig");
        $this->createNotFoundException();
        $template = str_replace("$.name.$", $command->getBusiness()->getName(), $template);
        $template = str_replace("$.mail.$", $command->getBusiness()->getUser()->getEmail(), $template);
        $template = str_replace("$.tel.$", $command->getBusiness()->getPhone(), $template);
        $swiftMessage = $this->emailFactory->create(
            'Nowa oferta współpracy',
            nl2br($template),
            [
                $command->getCandidateProfil()->getUser()->getEmail()
            ]
        );
        $this->mailer->send($swiftMessage);

    }
}