<?php


namespace App\Entity\SendOfferBusiness;


interface SendOfferBuisnessInterface
{
        public function add(SendOfferBusiness $sendOfferBusiness);
        public function LoadAllByIdBusiness(int $IdBusiness);
}