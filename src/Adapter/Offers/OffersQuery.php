<?php

namespace App\Adapter\Offers;

use App\Entity\Offers\Offers\ReadModel\OffersQueryInterface;
use App\Entity\Offers\Offers\ReadModel\OffersRead;
use Doctrine\DBAL\Connection;
use DateTime;


class OffersQuery implements OffersQueryInterface
{
    private $connection;

    public function __construct(
        Connection $connection
    )
    {
        $this->connection = $connection;
    }

    /**
     * @return Offers[]
     */


    public function findByUser(int $userid)
    {

        return $this->connection->project(
            'SELECT o.id as id, o.title as title, o.description as description, o.physique as physique,
    o.hair_length as hair_length, o.hair_color as hair_color,o.eye_color as eye_color,o.sex as sex,o.growth_min as growth_min,
    o.growth_max as growth_max,o.age_max as age_max,o.age_min as age_min,o.is_active as is_active,
    o.id_user_id as id_user_id,o.date_add as date_add
                    FROM offers as o 
                    WHERE o.id_user_id = :userId',
            [
                'userId' => $userid
            ],
            function ($result) {
                return new OffersRead(
                    (int)$result['id'],
                    $result['id_user_id'],
                    (string)$result['title'],
                    (string)$result['description'],
                    (string)$result['physique'],
                    (string)$result['hair_length'],
                    (string)$result['hair_color'],
                    (string)$result['eye_color'],
                    (string)$result['sex'],
                    (int)$result['growth_min'],
                    (int)$result['growth_max'],
                    (int)$result['age_max'],
                    (int)$result['age_min'],
                    (bool)$result['is_active'],
                    (new DateTime ($result['date_add']))
                );
            });
    }
    public function findForCandidat(string $physique,string $hairLength, string $hairColor, string $eyeColor, string $Sex, int $Growth, int $Age)
    {;
        $query="SELECT o.id as id, o.title as title, o.description as description, o.physique as physique,
    o.hair_length as hair_length, o.hair_color as hair_color,o.eye_color as eye_color,o.sex as sex,o.growth_min as growth_min,
    o.growth_max as growth_max,o.age_max as age_max,o.age_min as age_min,o.is_active as is_active,
    o.id_user_id as id_user_id,o.date_add as date_add
                    FROM offers as o 
                    WHERE o.physique = ('default' or '".$physique."') and o.hair_length = ('default' or '".$hairLength."') and o.hair_color = ('default' or '".$hairColor.
            "') and o.eye_color = ('default' or '".$eyeColor."') and o.sex = ('default' or '".$Sex."') and o.growth_min <= '".$Growth."' and o.growth_max >= ".$Growth." and o.age_min <= ".$Age." and o.age_max >= ".$Age." and o.is_active = true";
        return $this->connection->project(
            $query,
            [
            ],
            function ($result) {
                return new OffersRead(
                    (int)$result['id'],
                    $result['id_user_id'],
                    (string)$result['title'],
                    (string)$result['description'],
                    (string)$result['physique'],
                    (string)$result['hair_length'],
                    (string)$result['hair_color'],
                    (string)$result['eye_color'],
                    (string)$result['sex'],
                    (int)$result['growth_min'],
                    (int)$result['growth_max'],
                    (int)$result['age_max'],
                    (int)$result['age_min'],
                    (bool)$result['is_active'],
                    (new DateTime ($result['date_add']))
                );
            });
    }

}