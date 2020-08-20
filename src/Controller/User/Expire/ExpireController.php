<?php

namespace App\Controller\User\Expire;

use App\Adapter\User\Users;
use App\Entity\User\User\UseCase\ExpireUser;
use App\Entity\User\User;
use App\Entity\User\User\UseCase\ExpireUser\Command;
use App\Form\User\Expire\UserExpireType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User\User\UseCase\ExpireUser\Responder as TokenExpireResponder;

class ExpireController extends AbstractController implements TokenExpireResponder
{

    /**
     * @Route ("/{_locale}/users/expire", name="token_expire")
     * @throws \Throwable
     */
    public function expire(Request $request, Users $users, ExpireUser $expireUser){
        $form = $this->createForm(UserExpireType::class);
        $form->handleRequest($request);

        $tokenValue = md5(uniqid());

        $date = new DateTime('+60 minutes');

        if($form->isSubmitted() && $form->isValid()){

            $formData = $form->getData();

            $user = $users->findByEmail($formData['email']);

            $isNotActive = false;

            if($user->getIsActive() == $isNotActive ) {

                $commandData = new Command($user, $tokenValue, $date);
                $commandData->setResponder($this);

                $expireUser->candidate($commandData);

                return $this->redirectToRoute('homepage');
            }
        }
        return $this->render('User/Expire.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function UserTokenExpire(User $user)
    {
        $this->addFlash('success', 'Sprawdź swoją skrzynkę pocztową.');
    }
}