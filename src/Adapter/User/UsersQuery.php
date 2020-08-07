<?php

namespace App\Adapter\User;

use App\Entity\User\ReadModel\Users;
use App\Entity\User\ReadModel\UsersQueryInterface;
use App\Entity\User\User;
use Doctrine\DBAL\Connection;

class UsersQuery implements UsersQueryInterface
{
    private $connection;

    public function __construct(
        Connection $connection
    )
    {
        $this->connection = $connection;
    }

    /**
     * @return Users[]
     */

    public function getByToken(string $token)
    {
        return $this->connection->project(
            'SELECT u.id as id, u.email as email, u.password as password, u.is_active as is_active, u.token as token, u.token_expire as token_expire, u.roles as roles
                    FROM user as u 
                    WHERE u.token = :token',
            [
                'token' => $token
            ],
            function ($result) {
                return new Users(
                    (int)$result['id'],
                    (string)$result['email'],
                    (string)$result['password'],
                    (array($result['roles'])),
                    (bool)$result['is_active'],
                    (string)$result['token'],
                    (new \DateTime ($result['token_expire']))
                );
            }
        );
    }

    public function getByEmail(string $email)
    {
        return $this->connection->project(
            'SELECT u.id as id, u.email as email, u.password as password, u.is_active as is_active, u.token as token, u.token_expire as token_expire, u.roles as roles
                    FROM user as u 
                    WHERE u.email = :email',
            [
                'email' => $email
            ],
            function ($result) {
                return new Users(
                    (int)$result['id'],
                    (string)$result['email'],
                    (string)$result['password'],
                    (array($result['roles'])),
                    (bool)$result['is_active'],
                    (string)$result['token'],
                    (new \DateTime ($result['token_expire']))
                );
            }
        );
    }
}