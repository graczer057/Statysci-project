<?php

namespace App\Controller\BusinessGroupe\Activate;

use App\Adapter\User\Users;
use App\Entity\Business\Business;
use App\Entity\Business\UseCase\CreateBuisness;
use App\Entity\User\User\UseCase\ActivateUser\Responder as ActivateResponder;
use App\Entity\Business\UseCase\CreateBuisness\Responder as BusinessResponder;
use App\Entity\User\User;
use App\Form\BusinessGroupe\BusinessActivateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActivateController extends AbstractController implements BusinessResponder, ActivateResponder
{
    /**
     * @Route("/{_locale}/business/homepage/activate/{token}", name="business_activate")
     */
    public function Activate(Request $request, Users $users, string $token, CreateBuisness $createBuisness){
        $form = $this->createForm(BusinessActivateType::class, []);
        $form->handleRequest($request);

        $user = $users->findByToken($token);

        $date = new \DateTime("now");

        if($user->getTokenExpire()->getTimestamp() > $date->getTimestamp()){
            if($form->isSubmitted() && $form->isValid()){
                $data = $form->getData();

                $command = new CreateBuisness\Command(
                    $token,
                    $data['name'],
                    $data['nip'],
                    $data['adres'],
                    $data['telefon'],
                    $data['description']
                );

                $command->setResponder($this);

                $createBuisness->execute($command);

                return $this->render('homepage.html.twig', []);
            }
            return $this->render('BusinessGroupe/BusinessActivate.html.twig', [
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

    public function createBusiness(Business $business)
    {
        $this->addFlash('success', 'Twój profil został pomyślnie uzupełniony');
    }
}