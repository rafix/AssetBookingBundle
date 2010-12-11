<?php

namespace Application\AssetBookingBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

class StatusProfile
{
    protected $id;

    protected $name;
    protected $description;

    protected $items;
    protected $createdAt;
    protected $updatedAt;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

}