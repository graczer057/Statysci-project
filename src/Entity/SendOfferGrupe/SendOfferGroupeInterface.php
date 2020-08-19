<?php


namespace App\Entity\SendOfferGrupe;


interface SendOfferGroupeInterface
{
public function add(SendOfferGrupe $sendOfferGrupe);
public function LoadAllByIdGroup(int $idGroup);
}