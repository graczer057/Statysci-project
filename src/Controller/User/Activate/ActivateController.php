<?php


namespace App\Controller\User\Activate;

use App\Entity\User\User\UseCase\ActivateUser;
use App\Entity\User\User\UseCase\ActivateUser\Responder as ActivateResponder;
use App\Entity\User\User;
use App\Form\User\UserActivateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivateController extends AbstractController implements ActivateResponder
{
    /**
     * @Route("/{_locale}/homepage/activate/{token}", name="user_activate")
     */
    public function Activate(Request $request, ActivateUser $activateUser, User $user): Response{
        $form = $this->createForm(UserActivateType::class, []);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $command = new ActivateUser\Command(
                $user,
                $data['height'],
                $data['eyes'],
                $data['hair'],
                $data['weight'],
                $data['gender']
            );

            $command->setResponder($this);

            $activateUser->execute($command);

            return $this->render('homepage.html.twig', []);
        }
        return $this->render('User/UserActivate.html.twig', [
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
}