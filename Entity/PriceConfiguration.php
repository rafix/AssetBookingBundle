<?php

namespace Xerias\AssetBookingBundle\Entity;

/**
 * Xerias\AssetBookingBundle\Entity\PriceConfiguration
 */
class PriceConfiguration
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var string $accessSequence
     */
    private $accessSequence;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Xerias\AssetBookingBundle\Entity\PriceCondition
     */
    private $priceConditions;

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
     * Set accessSequence
     *
     * @param string $accessSequence
     */
    public function setAccessSequence($accessSequence)
    {
        $this->accessSequence = $accessSequence;
    }

    /**
     * Get accessSequence
     *
     * @return string $accessSequence
     */
    public function getAccessSequence()
    {
        return $this->accessSequence;
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
     * Add priceConditions
     *
     * @param Xerias\AssetBookingBundle\Entity\PriceCondition $priceConditions
     */
    public function addPriceCondition(\Xerias\AssetBookingBundle\Entity\PriceCondition $priceConditions)
    {
        $this->priceConditions[] = $priceConditions;
    }

    /**
     * Get priceConditions
     *
     * @return Doctrine\Common\Collections\Collection $priceConditions
     */
    public function getPriceConditions()
    {
        return $this->priceConditions;
    }
}