<?php
namespace App\Controller;

use App\Form\ChangeFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Security\Authenticator;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Mime\Email;

class ChangeController extends AbstractController
{
    private $entityManger;
    private $UserRepository;
    private $emailVerifier;
    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $UserRepository,
        EmailVerifier $emailVerifier
    ){
        $this->entityManger = $entityManager;
        $this->UserRepository = $UserRepository;
        $this->emailVerifier = $emailVerifier;
    }
    /**
     * @param string $token
     * @param Request $request
     * @return Response
     * @Route("/change/{token}", name="change_password", methods={"GET", "POST"})
     */
    public function change(string $token, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(ChangeFormType::class);
        $form->handleRequest($request);


        //dd($form);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $user = $this->UserRepository->findOneBy(['token' => $token]);
            if (is_null($user)) {
                throw new \Exception("User with token: {$token} not found", 404);
            }
            $date = new \DateTime("now");
            if ($user->getTokenExpire()->getTimestamp() > $date->getTimestamp()) {
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('repeatPassword')->getData()
                    ));
            } else {
                $this->addFlash('error', 'Password is the same as the oldest. Please type your new password once again.');
                return $this->render('change.html.twig', [
                    'form' => $form->createView()
                ]);
            }
            $user->setToken(null);
            $user->setDate(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Password changed');
            return $this->redirectToRoute('homepage');
        }
        return $this->render('change.html.twig', [
            'form' => $form->createView()
        ]);
    }
}