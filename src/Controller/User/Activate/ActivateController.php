<?php


namespace App\Controller\User\Activate;

use App\Adapter\User\Users;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile;
use App\Entity\User\User\UseCase\ActivateUser\Responder as ActivateResponder;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile\Responder as CandidateResponder;
use App\Entity\User\User;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Form\User\UserActivateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActivateController extends AbstractController implements ActivateResponder, CandidateResponder
{
    /**
     * @Route("/{_locale}/candidate/homepage/activate/{token}", name="candidate_activate")
     */
    public function Activate(Request $request, Users $users, string $token, CreateCandidateProfile $createCandidate){
        $form = $this->createForm(UserActivateType::class);
        $form->handleRequest($request);

        $date = new \DateTime("now");

        $user = $users->findByToken($token);

        if($user->getTokenExpire()->getTimestamp() > $date->getTimestamp()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                $command = new CreateCandidateProfile\Command(
                    $token,
                    $data['growth'],
                    $data['physique'],
                    $data['hair_length'],
                    $data['hair_color'],
                    $data['eye_color'],
                    $data['age']
                );

                $command->setResponder($this);

                $createCandidate->execute($command);

                return $this->render('homepage.html.twig', []);
            }
            return $this->render('User/UserActivate.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('token_expire');
        }
    }

    public function ActivateUser(User $user)
    {

        $this->addFlash('success', 'Twoje konto zostało aktywowane');
    }

    public function linkExpired()
    {
        $this->addFlash('error', 'Przepraszamy, ale twój link aktywacyjny wygasł');
    }

    public function createCandidate(CandidateProfil $candidate)
    {
        $this->addFlash('success', 'Twój profil został pomyślnie uzupełniony');
    }
}