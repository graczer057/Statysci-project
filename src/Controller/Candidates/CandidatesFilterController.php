<?php


namespace App\Controller\Candidates;


use App\Adapter\CandidateProfile\CandidateQuery;
use App\Adapter\User\Users;
use App\Form\Candidates\FiltrCandidatesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CandidatesFilterController extends AbstractController
{
    /**
     * @Route("/{_locale}/group/filter/candidate", name="filter_candidate")
     */
    public function main(Request $request,CandidateQuery $candidateQuery,Users $users){
        $form = $this->createForm(FiltrCandidatesType::class, []);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

                $data = $form->getData();
            if ($data['growthMax'] < $data['growthMin']) {
                $data['growthMax'] = $data['growthMin'];
            }
            if ($data['AgeMax'] < $data['AgeMin']) {
                $data['AgeMax'] = $data['AgeMin'];
            }
            if ($data['physique'] == 'default'){
                $physique = 'is not null';
            }else {
                $physique="= '".$data['physique']."'";
            }
            if ($data['hair_length'] == 'default'){
                $HairLength = 'is not null';
            }else {
                $HairLength="= '".$data['hair_length']."'";
            }
            if ($data['hair_color'] == 'default'){
                $HairColor = 'is not null';
            }else {
                $HairColor="= '".$data['hair_color']."'";
            }
            if ($data['eye_color'] == 'default'){
                $EyeColor = 'is not null';
            }else {
                $EyeColor="= '".$data['eye_color']."'";
            }

               $candidates=$candidateQuery->getfilter($data['growthMin'],$data['growthMax'],$physique,$HairLength,$HairColor,$EyeColor,$data['AgeMin'],$data['AgeMax']);


            return $this->render('Candidates/listCandidate.html.twig', [
                'candidates' => $candidates
            ]);
        }

        return $this->render('Candidates/FilterCandidates.html.twig', [
            'form' => $form->createView(),
        ]);


    }

}