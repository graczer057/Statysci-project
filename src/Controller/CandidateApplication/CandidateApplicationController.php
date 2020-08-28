<?php

namespace App\Controller\CandidateApplication;

use App\Adapter\CandidatApplication\CandidatApplication;
use App\Adapter\Core\Transaction;
use App\Adapter\User\Users;
use App\Entity\CandidateApplication\CandidateApplication\UseCase\CreateCandidateApplication;
use App\Entity\Offers\Offers;
use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CandidateApplicationController extends AbstractController
{
    private $mailer;
    private $users;

    public function __construct(
        \Swift_Mailer $mailer,
        Users $users
    ){
        $this->mailer = $mailer;
        $this->users = $users;
    }

    /**
     * @Route("/{_locale}/{id}/candidat/send/", name="send_application")
     */
    public function main(Offers $id, CreateCandidateApplication $createCandidateApplication){
        $data = $_REQUEST['valu'];

        /** @var User $user */
        $user = $this->getUser();

        $candidat = $user->getCandidateProfil();

        $status = "waiting";

        $command = new CreateCandidateApplication\Command($id, $candidat, $status);

        $createCandidateApplication->execute($command);

        return new JsonResponse('Button'.$data);
    }
}