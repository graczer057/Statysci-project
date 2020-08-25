<?php


namespace App\Entity\Offers\Offers\UseCase;


use App\Adapter\Core\Transaction;
use App\Adapter\Offers\Offers;
use App\Entity\Offers\Offers\UseCase\CreateOffer\Command;

class CreateOffer
{
    /**
     * @var Offers
     */
    private $offers;
    /**
     * @var Transaction
     */
    private $transaction;

    public function __construct(
        Offers $offers,
        Transaction $transaction
    )
    {
        $this->offers = $offers;
        $this->transaction = $transaction;
    }

    public function execute(Command $command)
    {
    $this->transaction->begin();
    $Offer=new \App\Entity\Offers\Offers(
        $command->getIdUser(),
        $command->getTitle(),
        $command->getDescription(),
        $command->getPhysoqie(),
        $command->getHairLength(),
        $command->getHairColor(),
        $command->getEyeColor(),
        $command->getSex(),
        $command->getGrowthMin(),
        $command->getGrowthMax(),
        $command->getAgeMax(),
        $command->getGrowthMin()
    );
    $this->offers->add($Offer);
        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollback();
            throw $e;
        }
    $command->getResponder()->CreateOffer();
    }


}