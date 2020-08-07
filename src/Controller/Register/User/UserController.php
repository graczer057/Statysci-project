<?php


namespace App\Controller\Register\User;

use App\Adapter\User\Users;
use App\Entity\User\User\UseCase\CreateUser;
use App\Entity\User\User\UseCase\CreateUser\Responder as RegisterResponder;
use App\Entity\User\User;
use App\Form\User\UserRegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController implements RegisterResponder
{
    /**
     * @Route("/register/user", name="user_register")
     * @param Request $request
     * @param CreateUser $createUser
     * @return Response
     * @throws \Throwable
     */
    public function register(Request $request, CreateUser $createUser): Response{
        $form = $this->createForm(UserRegisterType::class, []);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $command = new CreateUser\Command(
                $data['login'],
                $data['email'],
                [$data['role']],
                $form->get('plainPassword')->getData()
            );

            $command->setResponder($this);

            $createUser->execute($command);

            return $this->render('homepage.html.twig', []);
        }
        return $this->render('User/UserRegister.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function CreateUser(User $user)
    {
        $this->addFlash('success', 'Registration complete, now please check your email');
    }

    public function emailExists()
    {
        // TODO: Implement emailExists() method.
    }

    public function UserNameExists()
    {
        // TODO: Implement UserNameExists() method.
    }
}