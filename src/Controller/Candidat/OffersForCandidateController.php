<?php

namespace App\Controller\Candidat;

use App\Adapter\Offers\OffersQuery;
use App\Entity\Offers\Offers\ReadModel\OffersRead;
use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OffersForCandidateController extends AbstractController
{
    /**
     * @Route("/{_locale}/Candidat/Offers", name="OffersCandidat")
     */
    public function offer(OffersQuery $offersQuery){
        if($this->getUser() == null){
            return $this->redirectToRoute('homepage');
        }

        /** @var User $user */
        $user = $this->getUser();

        $candidat = $user->getCandidateProfil();

        $Offers = null;
        $offers = $offersQuery->findForCandidat($candidat->getPhysique(), $candidat->getHairLength(), $candidat->getHairColor(), $candidat->getEyeColor(), $candidat->getSex(), $candidat->getGrowth(), $candidat->getAge());

        foreach ($offers as $offer){
            $Offers[] = new OffersRead($offer->getId(),
                $user,
                $offer->getTitle(),
                $offer->getDescription(),
                $offer->getPhysique(),
                $offer->getHairLength(),
                $offer->getHairColor(),
                $offer->getEyeColor(),
                $offer->getSex(),
                $offer->getGrowthMin(),
                $offer->getGrowthMax(),
                $offer->getAgeMax(),
                $offer->getAgeMin(),
                $offer->getIsActive(),
                $offer->getDateTime()
            );
        }
        return $this->render('Candidat/OffersForCandidate.html.twig', [
            'offers' => $Offers
        ]);
    }
}