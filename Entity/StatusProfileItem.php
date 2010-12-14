<?php

namespace Application\AssetBookingBundle\Entity;

/**
 * Application\AssetBookingBundle\Entity\StatusProfileItem
 */
class StatusProfileItem
{
    /**
     * @var integer $position
     */
    private $position;

    /**
     * @var boolean $isCompleted
     */
    private $isCompleted;

    /**
     * @var boolean $isInit
     */
    private $isInit;

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
     * @var Application\AssetBookingBundle\Entity\Status
     */
    private $status;

    /**
     * Set position
     *
     * @param integer $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return integer $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set isCompleted
     *
     * @param boolean $isCompleted
     */
    public function setIsCompleted($isCompleted)
    {
        $this->isCompleted = $isCompleted;
    }

    /**
     * Get isCompleted
     *
     * @return boolean $isCompleted
     */
    public function getIsCompleted()
    {
        return $this->isCompleted;
    }

    /**
     * Set isInit
     *
     * @param boolean $isInit
     */
    public function setIsInit($isInit)
    {
        $this->isInit = $isInit;
    }

    /**
     * Get isInit
     *
     * @return boolean $isInit
     */
    public function getIsInit()
    {
        return $this->isInit;
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
     * Set status
     *
     * @param Application\AssetBookingBundle\Entity\Status $status
     */
    public function setStatus(\Application\AssetBookingBundle\Entity\Status $status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return Application\AssetBookingBundle\Entity\Status $status
     */
    public function getStatus()
    {
        return $this->status;
    }
}