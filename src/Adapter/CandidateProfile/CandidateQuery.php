<?php

namespace App\Adapter\CandidateProfile;

use App\Entity\CandidateProfil\ReadModel\CandidateProfile;
use App\Entity\CandidateProfil\ReadModel\CandidateProfileQueryInterface;
use App\Entity\User\User;
use Doctrine\DBAL\Driver\Connection;

class CandidateQuery implements CandidateProfileQueryInterface
{
    private $connection;

    public function __construct(
        Connection $connection
    ){
        $this->connection = $connection;
    }

    /**
     * @param int $id
     * @return CandidateProfile[]
     */
    public function getById(int $id)
    {
        return $this->connection->project(
            'SELECT c.id as id, c.growth as growth, c.physique as physique, c.hair_length as hair_length, c.hair_color as hair_color, c.eye_color as eye_color, c.age as age
                    From CandidateProfil as c',
                [
                    'id' => $id
                ],
                function (array $result){
                    return new CandidateProfile(
                        (int)$result['id'],
                        (int)$result['growth'],
                        (string)$result['physique'],
                        (string)$result['hair_length'],
                        (string)$result['hair_color'],
                        (string)$result['eye_color'],
                        (int)$result['age']
                    );
                }
        );
    }

    public function getByUser(User $user)
    {
        // TODO: Implement getByUser() method.
    }
}