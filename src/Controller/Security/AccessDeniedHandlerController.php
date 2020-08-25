<?php


namespace App\Controller\Security;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandlerController extends AbstractController implements AccessDeniedHandlerInterface
{
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        if ($this->getUser()->getRoles()==["ROLE_CANDIDATE"])
        {
            return $this->redirectToRoute('HomePageCandidat');
        }elseif ($this->getUser()->getRoles()==["ROLE_GROUP"]){
            return $this->redirectToRoute('OffersList');
        }elseif ($this->getUser()->getRoles()==["ROLE_BUSINESS"]){
            return $this->redirectToRoute('OffersList');
        }else{
            return $this->redirectToRoute('locals');
        }

    }
}