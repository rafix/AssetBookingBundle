<?php

namespace Application\AssetBookingBundle\Entity;


class Booking
{
    protected $id;
    protected $bookingReference;
    protected $groupInfoNumberOfAdults;
    protected $groupInfoNumberOfChildren;

    protected $consumptionElectricity;
    protected $consumptionGas;
    protected $consumptionFuel;
    protected $consumptionWater;
    
    protected $stateOfPropertyRemarks;
    protected $bookingRemarks;

    protected $status;

}