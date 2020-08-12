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
     * @Route("/{_locale}/business/homepage/activate/{token}", name="business_activate")
     */
    public function Activate(Request $request, Users $users, string $token, CreateActorGroup $createActorGroup){
        $form = $this->createForm(GroupActivateType::class, []);
        $form->handleRequest($request);

        $user = $users->findByToken($token);

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

            return $this->render('homepage.html.twig', []);
        }
        return $this->render('ActorGroupe/GroupActivate.html.twig', [
            'form' => $form->createView(),
        ]);
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