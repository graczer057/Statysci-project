<?php


namespace App\Controller\Homepage;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{    /**
 * @return Response
 * @Route("/", name="locals")
 */
    public function main(): Response{
        return $this->redirectToRoute('homepage');    }



    /**
     * @return Response
     * @Route("/{_locale}/homepage", name="homepage", defaults={"_locale":"%locale%"}, requirements={"_locale":"%app_locales%"})
     */
    public function Homepage(): Response{
        return $this->render('homepage.html.twig');
    }

}