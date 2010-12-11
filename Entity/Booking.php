<?php

namespace Application\AssetBookingBundle\Entity;


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

}