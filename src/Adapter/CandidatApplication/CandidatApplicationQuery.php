<?php


namespace App\Adapter\CandidatApplication;



use App\Entity\CandidateApplication\CandidateApplication\ReadModel\CandidateApplicationQueryInterface;
use App\Entity\CandidateApplication\CandidateApplication\ReadModel\CandidateApplicationReadModel;
use DateTime;
use Doctrine\DBAL\Driver\Connection;

class CandidatApplicationQuery implements CandidateApplicationQueryInterface
{
    private $connection;

    public function __construct(
        Connection $connection
    ){
        $this->connection = $connection;
    }

    /**
     * @param int $id
     * @return CandidateApplicationReadModel[]
     */

    public function findApplication(int $idOffer)
    {
        return $this->connection->project(
            'SELECT a.id as id,a.offer_id as offer_id,a.candidate_id as candidate_id,a.date_add as date_add,a.status as status
            From candidat_application as a
            WHERE a.offer_id = :idoffer and a.status = ("accepted" or "waiting")
            ORDER BY a.status',
            [
                'idoffer' => $idOffer
            ],
            function (array $result){
                return new CandidateApplicationReadModel(
                    (int)$result['id'],
                    $result['offer_id'],
                    $result['candidate_id'],
                    (new DateTime ($result['date_add'])),
                    $result['status']

                );
            }
        );
    }
}