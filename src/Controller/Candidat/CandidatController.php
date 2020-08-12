<?php


namespace App\Controller\Candidat;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CandidatController extends AbstractController
{

    /**
     * @Route("/{_locale}/Candidat", name="HomePageCandidat")
     */
    public function main(){
        return $this->render('Candidat/Candidat.html.twig',['user'=>$this->getUser()]);
    }
}