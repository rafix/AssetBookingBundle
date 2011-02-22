<?php

namespace Xerias\AssetBookingBundle\Entity;

/**
 * Xerias\AssetBookingBundle\Entity\AssetPeriodTypePrice
 */
class AssetPeriodTypePrice
{
    /**
     * @var integer $price
     */
    private $price;

    /**
     * @var datetime $priceFrom
     */
    private $priceFrom;

    /**
     * @var datetime $priceTo
     */
    private $priceTo;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Xerias\AssetBookingBundle\Entity\Asset
     */
    private $asset;

    /**
     * @var Xerias\AssetBookingBundle\Entity\AssetPeriodType
     */
    private $assetPeriodType;

    /**
     * Set price
     *
     * @param integer $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return integer $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceFrom
     *
     * @param datetime $priceFrom
     */
    public function setPriceFrom($priceFrom)
    {
        $this->priceFrom = $priceFrom;
    }

    /**
     * Get priceFrom
     *
     * @return datetime $priceFrom
     */
    public function getPriceFrom()
    {
        return $this->priceFrom;
    }

    /**
     * Set priceTo
     *
     * @param datetime $priceTo
     */
    public function setPriceTo($priceTo)
    {
        $this->priceTo = $priceTo;
    }

    /**
     * Get priceTo
     *
     * @return datetime $priceTo
     */
    public function getPriceTo()
    {
        return $this->priceTo;
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
     * @param Xerias\AssetBookingBundle\Entity\Asset $asset
     */
    public function setAsset(\Xerias\AssetBookingBundle\Entity\Asset $asset)
    {
        $this->asset = $asset;
    }

    /**
     * Get asset
     *
     * @return Xerias\AssetBookingBundle\Entity\Asset $asset
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * Set assetPeriodType
     *
     * @param Xerias\AssetBookingBundle\Entity\AssetPeriodType $assetPeriodType
     */
    public function setAssetPeriodType(\Xerias\AssetBookingBundle\Entity\AssetPeriodType $assetPeriodType)
    {
        $this->assetPeriodType = $assetPeriodType;
    }

    /**
     * Get assetPeriodType
     *
     * @return Xerias\AssetBookingBundle\Entity\AssetPeriodType $assetPeriodType
     */
    public function getAssetPeriodType()
    {
        return $this->assetPeriodType;
    }
}