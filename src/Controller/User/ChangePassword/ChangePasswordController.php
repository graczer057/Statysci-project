<?php


namespace App\Controller\User\ChangePassword;


use App\Adapter\User\Users;
use App\Entity\User\User\UseCase\PasswordChange;
use App\Entity\User\User\UseCase\PasswordChange\Command as PasswordChangeCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChangePasswordController extends AbstractController
{
    /**
     * @param Request $request
     * @throws \Exception
     * @Route("{_locale}/homepage/password/{token}", name="app_password_change", methods={"GET", "POST"})
     */
    public function main(string $token,Request $request,Users $User,PasswordChange $passwordChange )
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }


        $form=$this->createForm(\App\Form\User\PasswordReset\PasswordChange::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()) {
            $user=$User->findbyToken($token);
            $commendData= new PasswordChangeCommand($user,$form->get('plainPassword')->getData(),null,null);
            $passwordChange->execute($commendData);


            return $this->redirectToRoute('homepage');
        }

        return $this->render('User/PasswordChange.html.twig', [
            'form' => $form->createView(),
        ]);


    }

    public function PasswordChange()
    {
        $this->addFlash('success','Hasło zostało zmienione');
    }

    public function LostToken()
    {
        $this->addFlash('error','Token wygasł');
    }



}