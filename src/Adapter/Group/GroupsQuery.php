<?php

namespace App\Adapter\Group;

use App\Entity\Groups\Group;
use App\Entity\Groups\ReadModel\GroupsQueryInterface;
use Doctrine\DBAL\Connection;

class GroupsQuery implements GroupsQueryInterface
{
    private $connection;

    public function __construct(
        Connection $connection
    ){
        $this->connection = $connection;
    }

    /**
     * @return Groups[]
     */

    public function getByToken(string $token)
    {
        return $this->connection->project(
            'SELECT g.name as name, g.nip as nip, g.email as email, g.password as password, g.description as description, g.photoPath as photoPath, g.roles as roles, g.token as token, g.tokenExpire as tokenExpire, g.isActive as isActive
                    FROM group as g 
                    WHERE g.token = :token',
            [
                'token' => $token
            ],
            function($result){
                return new Group(
                    (string)$result['name'],
                    (int)$result['nip'],
                    (string)$result['email'],
                    (string)$result['password'],
                    (string)$result['description'],
                    (string)$result['photoPath'],
                    (array)$result['roles'],
                    (string)$result['token'],
                    (new \DateTime($result['tokenExpire'])),
                    (bool)$result['isActive']
                );
            }
        );
    }

    public function getByEmail(string $email)
    {
        return $this->connection->project(
            'SELECT g.name as name, g.nip as nip, g.email as email, g.password as password, g.description as description, g.photoPath as photoPath, g.roles as roles, g.token as token, g.tokenExpire as tokenExpire, g.isActive as isActive
                    FROM group as g 
                    WHERE g.token = :token',
            [
                'email' => $email
            ],
            function($result){
                return new Group(
                    (string)$result['name'],
                    (int)$result['nip'],
                    (string)$result['email'],
                    (string)$result['password'],
                    (string)$result['description'],
                    (string)$result['photoPath'],
                    (array)$result['roles'],
                    (string)$result['token'],
                    (new \DateTime($result['tokenExpire'])),
                    (bool)$result['isActive']
                );
            }
        );
    }
}