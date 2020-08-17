<?php

namespace App\Controller\Candidates;

use App\Adapter\CandidateProfile\CandidateQuery;
use App\Repository\CandidateProfil\CandidateProfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListCandidates extends AbstractController
{
    private $candidateRepository;
    private $candidateQuery;

    public function __construct(
        CandidateProfilRepository $candidateRepository,
        CandidateQuery $candidateQuery
    ){
        $this->candidateRepository = $candidateRepository;
        $this->candidateQuery = $candidateQuery;
    }

    /**
     * @Route("/{_locale}/group/list/candidate", name="list_candidate", methods={"GET"})
     */
    public function Home(){
        $candidates = $this->candidateRepository->findBy([], [
            'id' => 'DESC'
        ]);

        return $this->render('Candidates/listCandidate.html.twig', [
            'candidates' => $candidates
        ]);
    }
}