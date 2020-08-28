<?php


namespace App\Controller\Offers;

use App\Adapter\User\Users;
use App\Entity\CandidateApplication\CandidateApplication\UseCase\CreateCandidateApplication;
use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SendEmailAboutOfferToGroupController extends AbstractController
{
    private $mailer;
    private $users;

    public function __construct(\Swift_Mailer $mailer, Users $users){
        $this->mailer = $mailer;
        $this->users = $users;
    }

    /**
     * @Route("/{_locale}/candidat/loadbutton", name="loadButtonCandidat")
     */
    public function main(CreateCandidateApplication $application){
        $data = $_REQUEST['valu'];

        /** @var User $user */
        $user = $this->getUser();

        $candidat = $user->getCandidateProfil();

        $command = new CreateCandidateApplication\Command($data('id'), $candidat, "done");

        $application->execute($command);

        return new JsonResponse('Button'.$data);
    }
}