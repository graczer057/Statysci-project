<?php


namespace App\Controller\Offers;


use App\Adapter\Offers\OffersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowOffersController extends AbstractController
{

    /**
     * @Route("/{_locale}/group/offer/list",name="OffersList")
     */
    public function main(OffersQuery $offersQuery)
    {
        $offers=null;
        $offers=$offersQuery->findByUser($this->getUser()->getId());
        return $this->render("Group/listOffers.html.twig",['Offer'=>$offers]);
    }

}