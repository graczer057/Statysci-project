<?php


namespace App\Controller\Candidat;


use App\Entity\CandidateProfil\UseCase\ChangePhoto;
use App\Entity\CandidateProfil\UseCase\EditCandidate;
use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CandidatController extends AbstractController
{

    /**
     * @Route("/{_locale}/Candidat", name="HomePageCandidat")
     */
    public function main(){
        if ($this->getUser()==null) {
             return $this->redirectToRoute('locals');
         }

        return $this->render('Candidat/Candidat.html.twig',['user'=>$this->getUser(),
            'physiques'=>$this->getUser()->getCandidateProfil()->physiques(),
            'HairLengths'=>$this->getUser()->getCandidateProfil()->HairLengths(),
            'HairColors'=>$this->getUser()->getCandidateProfil()->HairColors(),
            'EyeColors'=>$this->getUser()->getCandidateProfil()->EyeColors()]);
    }

    /**
     * @Route("/{_locale}/Candidat/addCandidat", name="addCandidat")
     */
    public function addCandidat(Request $request,EditCandidate $editCandidate,ChangePhoto $photo){


        $formData =$request->request->all();
        $command= new EditCandidate\Command($this->getUser()->getCandidateProfil(),$formData['growth'],$formData['physique'],$formData['HairLength'],$formData['HairColor'],$formData['EyeColor'],$formData['age']);
        $editCandidate->execute($command);

        if ($request->files->get('file')!=null) {

            $file = $request->files->get('file');
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory, $filename
            );
            $scrPhoto=$uploads_directory."/".$filename;

            /** @var User $user */
            $user=$this->getUser();
            $command=new ChangePhoto\Command($user,$scrPhoto);
            $photo->execute($command);

        }
        return $this->redirectToRoute('homepage');

    }

}