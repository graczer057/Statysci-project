<?php


namespace App\Controller\Register;

use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="homepage")
     */
    public function Homepage(): Response{
        $user = $this->getUser();
        if ($user == null){
            return $this->render('Homepage/registerType.html.twig');
        } else {
            return $this->render('homepage.html.twig');
        }
    }
}