<?php

namespace App\Controller\ActorGroupe\Activate;

use App\Adapter\User\Users;
use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\ActorGrupe\UseCase\CreateActorGroup;
use App\Entity\ActorGrupe\UseCase\CreateActorGroup\Command;
use App\Entity\User\User\UseCase\ActivateUser\Responder as ActivateResponder;
use App\Entity\ActorGrupe\UseCase\CreateActorGroup\Responder as GroupResponder;
use App\Entity\User\User;
use App\Form\ActorGroupe\GroupActivateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActivateController extends AbstractController implements GroupResponder, ActivateResponder
{
    /**
     * @Route("/{_locale}/actor/homepage/activate/{token}", name="actor_activate")
     * @throws \Throwable
     */
    public function Activate(Request $request, Users $users, string $token, CreateActorGroup $createActorGroup){
        $form = $this->createForm(GroupActivateType::class, []);
        $form->handleRequest($request);

        $user = $users->findByToken($token);

        $date = new \DateTime("now");

        if($user->getTokenExpire()->getTimestamp() > $date->getTimestamp()){
            if($form->isSubmitted() && $form->isValid()){
                $data = $form->getData();

                $command = new Command(
                    $token,
                    $data['name'],
                    $data['adres'],
                    $data['telefon'],
                    $data['description']
                );

                $command->setResponder($this);

                $createActorGroup->execute($command);

                return $this->redirectToRoute('app_login');
            }
            return $this->render('ActorGroupe/GroupActivate.html.twig', [
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

    public function createGroup(ActorGrupe $actorGrupe)
    {
        $this->addFlash('success', 'Twój profil został pomyślnie uzupełniony');
    }
}