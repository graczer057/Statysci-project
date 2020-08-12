<?php


namespace App\Entity\Business\UseCase\CreateBuisness;

use App\Entity\Business\Business;

interface Responder
{
    public function createBusiness(Business $business);
    public function linkExpired();
}