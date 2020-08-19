<?php


namespace App\Entity\SendOfferGrupe\UseCase;


use App\Adapter\Core\EmailFactory;
use App\Adapter\Core\Transaction;
use App\Adapter\SendOfferBusiness\SendOfferBusiness;
use App\Adapter\SendOfferGroup\SendOfferGroup;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\SendOfferGrupe\SendOfferGrupe;
use App\Entity\SendOfferGrupe\UseCase\CreateSendOfferGroup\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateSendOfferGroup extends AbstractController
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
     * @var SendOfferGroup
     */
    private $group;

    public function __construct(
        Transaction $transaction,
        EmailFactory $emailFactory,
        \Swift_Mailer $mailer,
        SendOfferGroup $group
    )
    {
        $this->transaction = $transaction;
        $this->emailFactory = $emailFactory;
        $this->mailer = $mailer;
        $this->group = $group;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();

        $message= new SendOfferGrupe(
            $command->getActorGrupe(),
            $command->getCandidateProfil()
        );

        $this->group->add($message);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }


        $template = $this->renderView("mail/SendOfferGroup.html.twig");
        $this->createNotFoundException();
        $template = str_replace("$.name.$", $command->getActorGrupe()->getName(), $template);
        $template = str_replace("$.mail.$", $command->getActorGrupe()->getUser()->getEmail(), $template);
        $template = str_replace("$.tel.$", $command->getActorGrupe()->getPhone(), $template);
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