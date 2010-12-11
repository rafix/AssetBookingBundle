<?php

namespace Application\AssetBookingBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

class Booking
{
    protected $id;

    protected $bookingReference;

    protected $customer;
   
    protected $bookingRemarks;
    protected $items;

    protected $status;

    protected $createdAt;
    protected $updatedAt;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
}