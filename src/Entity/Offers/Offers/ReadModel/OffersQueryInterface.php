<?php


namespace App\Entity\Offers\Offers\ReadModel;


interface OffersQueryInterface
{
public function findByUser(int $userid);
}