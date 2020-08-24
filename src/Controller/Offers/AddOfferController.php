<?php


namespace App\Controller\Offers;


use App\Entity\Offers\Offers;
use App\Entity\Offers\Offers\UseCase\CreateOffer;
use App\Entity\Offers\Offers\UseCase\CreateOffer\Command;
use App\Entity\User\User;
use App\Form\Offers\CreateOfferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddOfferController extends AbstractController implements CreateOffer\Responder
{

    /**
     * @Route("/{_locale}/group/offer/add",name="OfferAdd")
     */
    public function main(Request $request, CreateOffer $createOffer)
    {
        $form = $this->createForm(CreateOfferType::class, []);

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


            $createOffer->execute($command);

            return $this->redirectToRoute("homepage");

        }
        return $this->render('Offers/CreateOffer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function CreateOffer()
    {
        $this->addFlash('success', 'Oferta gotowa');
    }
}