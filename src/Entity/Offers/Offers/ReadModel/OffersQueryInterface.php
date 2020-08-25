<?php


namespace App\Entity\Offers\Offers\ReadModel;


interface OffersQueryInterface
{
public function findByUser(int $userid);
public function findForCandidat(string $physique,string $hairLength,string $hairColor,string $eyeColor, string $Sex,int $Growth,int $Age);
}