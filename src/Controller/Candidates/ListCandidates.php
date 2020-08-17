<?php

namespace App\Controller\Candidates;

use App\Adapter\CandidateProfile\CandidateQuery;
use App\Adapter\User\Users;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile;
use App\Entity\CandidateProfil\UseCase\CreateCandidateProfile\Command;
use App\Entity\User\User\UseCase\CreateUser;
use App\Repository\CandidateProfil\CandidateProfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListCandidates extends AbstractController
{
    private $candidateRepository;
    private $candidateQuery;
    /**
     * @var Users
     */
    private $users;

    public function __construct(
        CandidateProfilRepository $candidateRepository,
        CandidateQuery $candidateQuery,
        Users $users
    )
    {
        $this->candidateRepository = $candidateRepository;
        $this->candidateQuery = $candidateQuery;
        $this->users = $users;
    }

    /**
     * @Route("/{_locale}/group/list/candidate", name="list_candidate", methods={"GET"})
     */
    public function Home()
    {
        $candidates = $this->candidateRepository->findBy([], [
            'id' => 'DESC'
        ]);

        return $this->render('Candidates/listCandidate.html.twig', [
            'candidates' => $candidates
        ]);
    }



}
