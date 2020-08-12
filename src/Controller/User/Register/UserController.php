<?php


namespace App\Controller\User\Register;

use App\Adapter\User\Users;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile\Command;
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
     * @Route("/{_locale}/homepage/users/register", name="user_register")
     * @param Request $request
     * @param CreateUser $createUser
     * @return Response
     * @throws \Throwable
     */
    public function register(Request $request, CreateUser $createUser,Users $users,CreateCandidateProfile $createCandidateProfile): Response{
        $form = $this->createForm(UserRegisterType::class, []);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $role = ["ROLE_CANDIDATE"];

            $command = new CreateUser\Command(
                $data['login'],
                $data['email'],
                $role,
                $form->get('plainPassword')->getData()
            );

            $command->setResponder($this);

            $createUser->execute($command);
            $User=$users->findByEmail( $data['email']);
            if ($User!=null){
                if ($User->getLogin()==$data['login']){
                    $command=new Command($User);
                    $createCandidateProfile->execute($command);
                }
            }
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
        $this->addFlash('error', 'Account with this email already exists, please type another email');
    }
}