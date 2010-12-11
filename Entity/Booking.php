<?php

namespace Application\AssetBookingBundle\Entity;

/**
 * Application\AssetBookingBundle\Entity\Booking
 */
class Booking
{
    /**
     * @var string $bookingReference
     */
    private $bookingReference;

    /**
     * @var text $bookingRemarks
     */
    private $bookingRemarks;

    /**
     * @var string $status
     */
    private $status;

    /**
     * @var datetime $createdAt
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     */
    private $updatedAt;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Application\AssetBookingBundle\Entity\Customer
     */
    private $customer;

    /**
     * @var Application\AssetBookingBundle\Entity\BookingItem
     */
    private $items;

    /**
     * Set bookingReference
     *
     * @param string $bookingReference
     */
    public function setBookingReference($bookingReference)
    {
        $this->bookingReference = $bookingReference;
    }

    /**
     * Get bookingReference
     *
     * @return string $bookingReference
     */
    public function getBookingReference()
    {
        return $this->bookingReference;
    }

    /**
     * Set bookingRemarks
     *
     * @param text $bookingRemarks
     */
    public function setBookingRemarks($bookingRemarks)
    {
        $this->bookingRemarks = $bookingRemarks;
    }

    /**
     * Get bookingRemarks
     *
     * @return text $bookingRemarks
     */
    public function getBookingRemarks()
    {
        return $this->bookingRemarks;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customer
     *
     * @param Application\AssetBookingBundle\Entity\Customer $customer
     */
    public function setCustomer(\Application\AssetBookingBundle\Entity\Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get customer
     *
     * @return Application\AssetBookingBundle\Entity\Customer $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Add items
     *
     * @param Application\AssetBookingBundle\Entity\BookingItem $items
     */
    public function addItems(\Application\AssetBookingBundle\Entity\BookingItem $items)
    {
        $this->items[] = $items;
    }

    /**
     * Get items
     *
     * @return Doctrine\Common\Collections\Collection $items
     */
    public function getItems()
    {
        return $this->items;
    }
}