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
            'SELECT c.id as id,c.user_id as user_id, c.growth as growth, c.physique as physique, c.hair_length as hair_length, c.hair_color as hair_color, c.eye_color as eye_color, c.age as age
                    From CandidateProfil as c',
                [
                    'id' => $id
                ],
                function (array $result){
                    return new CandidateProfile(
                        (int)$result['id'],
                        (int)$result['user_id'],
                        (int)$result['growth'],
                        (string)$result['physique'],
                        (string)$result['hair_length'],
                        (string)$result['hair_color'],
                        (string)$result['eye_color'],
                        (int)$result['age'],
                        (string)$result['sex'],
                        (string)$result['first_name'],
                        (string)$result['surname']
                    );
                }
        );
    }

    public function getByUser(User $user)
    {
        return $this->connection->project(
            'SELECT c.id as id, c.user_id as user_id, c.growth as growth, c.physique as physique, c.hair_length as hair_length, c.hair_color as hair_color, c.eye_color as eye_color, c.age as age, c.sex as sex, c.first_name as first_name, c.surname as surname
            From candidate_profil as c',
            [
                'user_id' => $user
            ],
            function (array $result){
                return new CandidateProfile(
                    (int)$result['id'],
                    $result['user_id'],
                    (int)$result['growth'],
                    (string)$result['physique'],
                    (string)$result['hair_length'],
                    (string)$result['hair_color'],
                    (string)$result['eye_color'],
                    (int)$result['age'],
                    (string)$result['sex'],
                    (string)$result['first_name'],
                    (string)$result['surname']
                );
            }
        );
    }
    public function getfilter(int $growthmin, int $growthmax, string $physique, string $hairLength, string $hairColor, string $eyeColor, int $agemin, int $agemax,string $sex)
    {
        $query='SELECT c.id as id, c.user_id as user_id, c.growth as growth, c.physique as physique, c.hair_length as hair_length, c.hair_color as hair_color, c.eye_color as eye_color, c.age as age, c.sex as sex, c.first_name as first_name, c.surname as surname
                    From candidate_profil as c
                    WHERE  
                    c.growth >= '.$growthmin.' and c.growth <= '.$growthmax.' and c.physique '.$physique.' and c.hair_length '.$hairLength.' and c.hair_color '.$hairColor.' and c.eye_color '.$eyeColor.' and c.age >='.$agemin.' and c.age <='.$agemax.' and c.sex '.$sex.' and c.is_show = true';

        return $this->connection->project(
            $query,
            [

            ],
            function (array $result){
                return new CandidateProfile(
                    (int)$result['id'],
                    $result['user_id'],
                    (int)$result['growth'],
                    (string)$result['physique'],
                    (string)$result['hair_length'],
                    (string)$result['hair_color'],
                    (string)$result['eye_color'],
                    (int)$result['age'],
                    (string)$result['sex'],
                    (string)$result['first_name'],
                    (string)$result['surname']
                );
            }
        );
    }
}