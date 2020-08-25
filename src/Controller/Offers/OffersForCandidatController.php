<?php


namespace App\Controller\Offers;


use App\Adapter\Offers\OffersQuery;
use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OffersForCandidatController extends AbstractController
{

    /**
     * @Route("/{_locale}/Candidat/show/offer")
     */
    public function main(OffersQuery $query)
    {
        /** @var User $user */
        $user=$this->getUser();
        $Candidate=$user->getCandidateProfil();
dd($query->findForCandidat($Candidate->getPhysique(),$Candidate->getHairLength(),$Candidate->getHairColor(),$Candidate->getEyeColor(),
$Candidate->getSex(),$Candidate->getGrowth(),$Candidate->getAge()));
    }
}