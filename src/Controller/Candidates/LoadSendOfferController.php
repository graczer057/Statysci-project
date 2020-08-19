<?php


namespace App\Controller\Candidates;


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

    public function __construct(
        SendOfferGroup $group
    )
    {
        $this->group = $group;
    }

    /**
     * @Route("/{_locale}/group/loadbutton", name="loadButton")
     */
    public function main()
    {
        $Groups=$this->group->LoadAllByIdGroup($this->getUser()->getActorGrupe()->getId());

        foreach ($Groups as $Group)
        {
            $groups[]="Button".$Group->getCandidat()->getUser()->getLogin();
        }

        return new JsonResponse($groups);
    }

}