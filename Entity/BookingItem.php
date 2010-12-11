<?php

namespace Application\AssetBookingBundle\Entity;


class BookingItem
{
    protected $id;

    protected $asset;
    
    protected $groupInfoNumberOfAdults;
    protected $groupInfoNumberOfChildren;

    protected $consumptionElectricity;
    protected $consumptionGas;
    protected $consumptionFuel;
    protected $consumptionWater;
    
    protected $stateOfPropertyRemarks;

    protected $createdAt;
    protected $updatedAt;

}