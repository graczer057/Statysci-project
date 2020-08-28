<?php


namespace App\Controller\Offers;


use App\Adapter\CandidatApplication\CandidatApplicationQuery;
use App\Entity\Offers\Offers;
use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowCandidateForOfferController extends AbstractController
{
    /**
     * @Route("/{_locale}/group/offer/candidate/{idoffer}", name="CandidateForOffer")
     */
    public function main(Offers $idoffer,CandidatApplicationQuery $applicationQuery)
    {
        /** @var User $user */
        $user=$this->getUser();

        if ($idoffer->getIdUser()->getId() != $user->getId())
        {
            return $this->redirectToRoute('OffersList');
        }
        $application=null;
        $application=$applicationQuery->findApplication($idoffer->getId());

        return $this->render('Offers/ShowCandidate.html.twig');
    }
}