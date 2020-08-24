<?php


namespace App\Controller\Offers;


use App\Entity\Offers\Offers;
use App\Entity\User\User;
use App\Form\Offers\CreateOfferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OfferEditController extends AbstractController
{
    /**
     * @Route("/{_locale}/group/offer/edit/{idoffer}", name="OfferEditController")
     */
    public function main(Offers $idoffer,Request $request){

        /** @var User $user */
        $user=$this->getUser();

        if ($idoffer->getIdUser()->getId() != $user->getId())
        {
            return $this->redirectToRoute('OffersList');
        }

        $form = $this->createForm(CreateOfferType::class, $idoffer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            /** @var User $user */
            $user = $this->getUser();
            $command = new Command(
                $user,
                $data['title'],
                $data['description'],
                $data['physique'],
                $data['hair_length'],
                $data['hair_color'],
                $data['eye_color'],
                $data['sex'],
                $data['growthMin'],
                $data['growthMax'],
                $data['AgeMax'],
                $data['AgeMin']);



            return $this->redirectToRoute("homepage");

        }
        return $this->render('Offers/CreateOffer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}