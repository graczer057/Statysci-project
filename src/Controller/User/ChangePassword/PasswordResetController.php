<?php


namespace App\Controller\User\ChangePassword;


use App\Adapter\User\Users;
use App\Entity\User\User;
use App\Entity\User\User\UseCase\PasswordReset\Command as PasswordResetCommand;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User\User\UseCase\PasswordReset\Responder as PasswordResetResponder;

class PasswordResetController extends AbstractController implements PasswordResetResponder
{
    /**
     * @param Request $request
     * @throws \Exception
     * @Route("{_locale}/homepage/Password", name="app_PasswordReset", methods={"GET", "POST"})
     */
    public function main(Request $request,User\UseCase\PasswordReset $passwordReset,Users $User)
    {

        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(\App\Form\User\PasswordReset\PasswordReset::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $commendData = new PasswordResetCommand($User->findByEmail($formData['email']), md5(uniqid()), new DateTime('+15 minutes'));

            $passwordReset->execute($commendData);


            return $this->redirectToRoute('homepage');

        }
        return $this->render('User/PasswordReset.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function passwordreset(User $user)
    {
        // TODO: Implement passwordreset() method.
    }
}