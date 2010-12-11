<?php

namespace Application\AssetBookingBundle\Entity;


class StatusProfileItem
{
    protected $id;

    protected $status;
    protected $sequenceNumber;
    protected $createdAt;
    protected $updatedAt;

    public function setStatus(Application\AssetBookingBundle\Entity\Status $status){
        $this->status = $status;
    }
}