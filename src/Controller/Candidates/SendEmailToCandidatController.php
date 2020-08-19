<?php


namespace App\Controller\Candidates;


use App\Adapter\CandidateProfile\Candidates;
use App\Adapter\User\Users;
use App\Entity\SendOfferBusiness\UseCase\CreateSendOfferBuisness;
use App\Entity\SendOfferBusiness\UseCase\CreateSendOfferBuisness\Command;
use App\Entity\SendOfferGrupe\UseCase\CreateSendOfferGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SendEmailToCandidatController extends AbstractController
{
    private $mailer;
    /**
     * @var Users
     */
    private $users;

    public function __construct(\Swift_Mailer $mailer,Users $users )
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    /**
     * @Route("/{_locale}/group/send/", name="send_candidate_mail")
     */
    public function main(CreateSendOfferBuisness $createSendOfferBuisness,CreateSendOfferGroup $createSendOfferGroup ){
        $data = $_REQUEST['valu'];
        if ($this->getUser()->getRoles()==['ROLE_GROUP'])
        {
            $command=new CreateSendOfferGroup\Command($this->getUser()->getActorGrupe(),$this->users->findByUserName($data)->getCandidateProfil());
            $createSendOfferGroup->execute($command);
            return new JsonResponse('Button'.$data);

        }else if ($this->getUser()->getRoles()==["ROLE_BUSINESS"])
        {

            $command=new Command($this->getUser()->getBusiness(),$this->users->findByUserName($data)->getCandidateProfil());
            $createSendOfferBuisness->execute($command);
            return new JsonResponse('Button'.$data);

        }
        return new JsonResponse('error');

    }
}