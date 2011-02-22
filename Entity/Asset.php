<?php

namespace Xerias\AssetBookingBundle\Entity;

/**
 * Xerias\AssetBookingBundle\Entity\Asset
 */
class Asset
{
    /**
     * @var datetime $availableFrom
     */
    private $availableFrom;

    /**
     * @var datetime $availableTo
     */
    private $availableTo;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

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
     * @var Xerias\AssetBookingBundle\Entity\AssetPeriodType
     */
    private $assetPeriodTypes;

    /**
     * Set availableFrom
     *
     * @param datetime $availableFrom
     */
    public function setAvailableFrom($availableFrom)
    {
        $this->availableFrom = $availableFrom;
    }

    /**
     * Get availableFrom
     *
     * @return datetime $availableFrom
     */
    public function getAvailableFrom()
    {
        return $this->availableFrom;
    }

    /**
     * Set availableTo
     *
     * @param datetime $availableTo
     */
    public function setAvailableTo($availableTo)
    {
        $this->availableTo = $availableTo;
    }

    /**
     * Get availableTo
     *
     * @return datetime $availableTo
     */
    public function getAvailableTo()
    {
        return $this->availableTo;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
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
     * Add assetPeriodTypes
     *
     * @param Xerias\AssetBookingBundle\Entity\AssetPeriodType $assetPeriodTypes
     */
    public function addAssetPeriodType(\Xerias\AssetBookingBundle\Entity\AssetPeriodType $assetPeriodTypes)
    {
        $this->assetPeriodTypes[] = $assetPeriodTypes;
    }

    /**
     * Get assetPeriodTypes
     *
     * @return Doctrine\Common\Collections\Collection $assetPeriodTypes
     */
    public function getAssetPeriodTypes()
    {
        return $this->assetPeriodTypes;
    }
}