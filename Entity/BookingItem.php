<?php

namespace Application\AssetBookingBundle\Entity;

/**
 * Application\AssetBookingBundle\Entity\BookingItem
 */
class BookingItem
{
    /**
     * @var integer $groupInfoNumberOfAdults
     */
    private $groupInfoNumberOfAdults;

    /**
     * @var integer $groupInfoNumberOfChildren
     */
    private $groupInfoNumberOfChildren;

    /**
     * @var float $consumptionElectricity
     */
    private $consumptionElectricity;

    /**
     * @var float $consumptionFuel
     */
    private $consumptionFuel;

    /**
     * @var float $consumptionGas
     */
    private $consumptionGas;

    /**
     * @var float $consumptionWater
     */
    private $consumptionWater;

    /**
     * @var text $stateOfPropertyRemarks
     */
    private $stateOfPropertyRemarks;

    /**
     * @var datetime $checkInDate
     */
    private $checkInDate;

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
     * @var Application\AssetBookingBundle\Entity\Asset
     */
    private $asset;

    /**
     * Set groupInfoNumberOfAdults
     *
     * @param integer $groupInfoNumberOfAdults
     */
    public function setGroupInfoNumberOfAdults($groupInfoNumberOfAdults)
    {
        $this->groupInfoNumberOfAdults = $groupInfoNumberOfAdults;
    }

    /**
     * Get groupInfoNumberOfAdults
     *
     * @return integer $groupInfoNumberOfAdults
     */
    public function getGroupInfoNumberOfAdults()
    {
        return $this->groupInfoNumberOfAdults;
    }

    /**
     * Set groupInfoNumberOfChildren
     *
     * @param integer $groupInfoNumberOfChildren
     */
    public function setGroupInfoNumberOfChildren($groupInfoNumberOfChildren)
    {
        $this->groupInfoNumberOfChildren = $groupInfoNumberOfChildren;
    }

    /**
     * Get groupInfoNumberOfChildren
     *
     * @return integer $groupInfoNumberOfChildren
     */
    public function getGroupInfoNumberOfChildren()
    {
        return $this->groupInfoNumberOfChildren;
    }

    /**
     * Set consumptionElectricity
     *
     * @param float $consumptionElectricity
     */
    public function setConsumptionElectricity($consumptionElectricity)
    {
        $this->consumptionElectricity = $consumptionElectricity;
    }

    /**
     * Get consumptionElectricity
     *
     * @return float $consumptionElectricity
     */
    public function getConsumptionElectricity()
    {
        return $this->consumptionElectricity;
    }

    /**
     * Set consumptionFuel
     *
     * @param float $consumptionFuel
     */
    public function setConsumptionFuel($consumptionFuel)
    {
        $this->consumptionFuel = $consumptionFuel;
    }

    /**
     * Get consumptionFuel
     *
     * @return float $consumptionFuel
     */
    public function getConsumptionFuel()
    {
        return $this->consumptionFuel;
    }

    /**
     * Set consumptionGas
     *
     * @param float $consumptionGas
     */
    public function setConsumptionGas($consumptionGas)
    {
        $this->consumptionGas = $consumptionGas;
    }

    /**
     * Get consumptionGas
     *
     * @return float $consumptionGas
     */
    public function getConsumptionGas()
    {
        return $this->consumptionGas;
    }

    /**
     * Set consumptionWater
     *
     * @param float $consumptionWater
     */
    public function setConsumptionWater($consumptionWater)
    {
        $this->consumptionWater = $consumptionWater;
    }

    /**
     * Get consumptionWater
     *
     * @return float $consumptionWater
     */
    public function getConsumptionWater()
    {
        return $this->consumptionWater;
    }

    /**
     * Set stateOfPropertyRemarks
     *
     * @param text $stateOfPropertyRemarks
     */
    public function setStateOfPropertyRemarks($stateOfPropertyRemarks)
    {
        $this->stateOfPropertyRemarks = $stateOfPropertyRemarks;
    }

    /**
     * Get stateOfPropertyRemarks
     *
     * @return text $stateOfPropertyRemarks
     */
    public function getStateOfPropertyRemarks()
    {
        return $this->stateOfPropertyRemarks;
    }

    /**
     * Set checkInDate
     *
     * @param datetime $checkInDate
     */
    public function setCheckInDate($checkInDate)
    {
        $this->checkInDate = $checkInDate;
    }

    /**
     * Get checkInDate
     *
     * @return datetime $checkInDate
     */
    public function getCheckInDate()
    {
        return $this->checkInDate;
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
     * Set asset
     *
     * @param Application\AssetBookingBundle\Entity\Asset $asset
     */
    public function setAsset(\Application\AssetBookingBundle\Entity\Asset $asset)
    {
        $this->asset = $asset;
    }

    /**
     * Get asset
     *
     * @return Application\AssetBookingBundle\Entity\Asset $asset
     */
    public function getAsset()
    {
        return $this->asset;
    }
}