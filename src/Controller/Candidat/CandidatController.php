<?php


namespace App\Controller\Candidat;


use App\Entity\CandidateProfil\UseCase\EditCandidate;
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
    public function addCandidat(Request $request,EditCandidate $editCandidate){


        $formData =$request->request->all();
        $command= new EditCandidate\Command($this->getUser()->getCandidateProfil(),$formData['growth'],$formData['physique'],$formData['HairLength'],$formData['HairColor'],$formData['EyeColor'],$formData['age']);
        $editCandidate->execute($command);
        echo "<pre>";
var_dump($request);die;
if ($request->files->get('post')['file']!=null) {
            $file = $request->files->get('post')['my_file'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            dd($file);
            $file->move(
                $uploads_directory, $filename
            );
        }
        return $this->redirectToRoute('homepage');

    }

}