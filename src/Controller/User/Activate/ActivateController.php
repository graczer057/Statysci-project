<?php


namespace App\Controller\User\Activate;

use App\Adapter\User\Users;
use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\ActorGrupe\UseCase\CreateActorGroup;
use App\Entity\Business\Business;
use App\Entity\Business\UseCase\CreateBuisness;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile;
use App\Entity\User\User\UseCase\ActivateUser\Responder as ActivateResponder;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile\Responder as CandidateResponder;
use App\Entity\Business\UseCase\CreateBuisness\Responder as CreateBusinessResponder;
use App\Entity\ActorGrupe\UseCase\CreateActorGroup\Responder as ActorGroupResponder;
use App\Entity\User\User;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Form\ActorGroupe\GroupActivateType;
use App\Form\BusinessGroupe\BusinessActivateType;
use App\Form\User\UserActivateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivateController extends AbstractController implements ActivateResponder, CandidateResponder, CreateBusinessResponder,ActorGroupResponder
{
    /**
     * @Route("/{_locale}/activate/{token}", name="activate")
     */
    public function Activate(Request $request, Users $users, string $token, CreateCandidateProfile $createCandidate, CreateActorGroup $createGroup, CreateBuisness $createBuisness): Response{

        $date = new \DateTime("now");

        $user = $users->findByToken($token);

        if($user!=null) {
            if ($user->getTokenExpire()->getTimestamp() > $date->getTimestamp()) {
                if ($user->getRoles() == ["ROLE_CANDIDATE"]) {
                    $form = $this->createForm(UserActivateType::class);
                    $form->handleRequest($request);
                    if ($form->isSubmitted() && $form->isValid()) {
                        $data = $form->getData();

                        $command = new CreateCandidateProfile\Command(
                            $token,
                            $data['growth'],
                            $data['physique'],
                            $data['hair_length'],
                            $data['hair_color'],
                            $data['eye_color'],
                            $data['age'],
                            $data['sex']
                        );
                        $command->setResponder($this);

                        $createCandidate->execute($command);

                        return $this->redirectToRoute('homepage');
                    }
                    return $this->render('User/UserActivate.html.twig', [
                        'form' => $form->createView(),
                    ]);
                } else if ($user->getRoles() == ["ROLE_GROUP"]) {
                    $form = $this->createForm(GroupActivateType::class);
                    $form->handleRequest($request);
                    if ($form->isSubmitted() && $form->isValid()) {
                        $data = $form->getData();

                        $command = new CreateActorGroup\Command(
                            $token,
                            $data['name'],
                            $data['address'],
                            $data['phone'],
                            $data['description']
                        );
                        $command->setResponder($this);

                        $createGroup->execute($command);

                        return $this->redirectToRoute('homepage');
                    }
                    return $this->render('ActorGroupe/GroupActivate.html.twig', [
                        'form' => $form->createView(),
                    ]);
                } else if ($user->getRoles() == ["ROLE_BUSINESS"]) {
                    $form = $this->createForm(BusinessActivateType::class);
                    $form->handleRequest($request);
                    if ($form->isSubmitted() && $form->isValid()) {
                        $data = $form->getData();

                        $command = new CreateBuisness\Command(
                            $token,
                            $data['name'],
                            $data['nip'],
                            $data['address'],
                            $data['phone'],
                            $data['description']
                        );
                        $command->setResponder($this);

                        $createBuisness->execute($command);

                        return $this->redirectToRoute('homepage');
                    }
                    return $this->render('BusinessGroupe/BusinessActivate.html.twig', [
                        'form' => $form->createView(),
                    ]);
                } else {
                    return $this->redirectToRoute('homepage');
                }
            } else {
                return $this->redirectToRoute('token_expire');
            }
        }
        else{
            return $this->redirectToRoute('homepage');
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
        $this->addFlash('success', 'Twoje konto zostało aktywowane');
    }
    public function createBusiness(Business $business){
        $this->addFlash('success', 'Twoje konto zostało aktywowane');

    }
    public function createGroup(ActorGrupe $actorGrupe)
    {
        $this->addFlash('success', 'Twoje konto zostało aktywowane');
    }
}