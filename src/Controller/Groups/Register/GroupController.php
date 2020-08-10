<?php


namespace App\Controller\Groups\Register;

use App\Entity\Groups\UseCase\CreateGroup;
use App\Entity\Groups\UseCase\CreateGroup\Responder as RegisterResponder;
use App\Entity\Groups\Group;
use App\Form\Group\GroupRegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController implements RegisterResponder
{
    /**
     * @Route("/{_locale}/groups/register", name="groups_register")
     * @throws \Throwable
     */
    public function register(Request $request, CreateGroup $createGroup): Response{
        $form = $this->createForm(GroupRegisterType::class, []);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $nipNull = ["group"];

            $nipGood = ["business"];

            if($form->get('nip')->getData() == null){
                $command = new CreateGroup\Command(
                    $data['name'],
                    $data['nip'],
                    $data['email'],
                    $form->get('plainPassword')->getData(),
                    $nipNull,
                    $data['description']
                );

                $command->setResponder($this);

                $createGroup->execute($command);

                return $this->render('homepage.html.twig', []);
            } else {
                $command = new CreateGroup\Command(
                    $data['name'],
                    $data['nip'],
                    $data['email'],
                    $form->get('plainPassword')->getData(),
                    $nipGood,
                    $data['description']
                );

                $command->setResponder($this);

                $createGroup->execute($command);

                return $this->render('homepage.html.twig', []);
            }
        }
        return $this->render('Groups/GroupRegister.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function CreateGroup(Group $group)
    {
        $this->addFlash('success', 'Registration complete, now please check your email');
    }

    public function CreateBusiness(Group $group)
    {
        $this->addFlash('success', 'Registration complete, now please check your email');
    }

    public function NameOfGroupExists()
    {
        $this->addFlash('error', 'Company with this name already exists, please type another email');
    }
}