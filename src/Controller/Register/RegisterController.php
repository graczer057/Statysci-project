<?php


namespace App\Controller\Register;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="homepage", methods={"GET"})
     */
    public function Homepage(): Response{
        return $this->render('homepage.html.twig');
    }
}