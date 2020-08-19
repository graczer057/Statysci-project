<?php


namespace App\Controller\Candidates;


use App\Adapter\SendOfferBusiness\SendOfferBusiness;
use App\Adapter\SendOfferGroup\SendOfferGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LoadSendOfferController extends AbstractController
{
    /**
     * @var SendOfferGroup
     */
    private $group;
    /**
     * @var SendOfferBusiness
     */
    private $business;

    public function __construct(
        SendOfferGroup $group,
        SendOfferBusiness $business
    )
    {
        $this->group = $group;
        $this->business = $business;
    }

    /**
     * @Route("/{_locale}/group/loadbutton", name="loadButton")
     */
    public function main()
    {
        if ($this->getUser()->getRoles() == ['ROLE_GROUP']) {
            $Groups = $this->group->LoadAllByIdGroup($this->getUser()->getActorGrupe()->getId());
        } else if ($this->getUser()->getRoles() == ["ROLE_BUSINESS"]) {
            $Groups = $this->business->LoadAllByIdBusiness($this->getUser()->getBusiness()->getId());
        }

        $date = new \DateTime("-15 day");

        foreach ($Groups as $Group) {
            if ($Group->getSendDate() > $date) {
                $groups[] = "Button" . $Group->getCandidat()->getUser()->getLogin();

            }
        }

        return new JsonResponse($groups);
    }

}