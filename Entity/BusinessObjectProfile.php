<?php

namespace Xerias\AssetBookingBundle\Entity;

/**
 * Xerias\AssetBookingBundle\Entity\BusinessObjectProfile
 */
class BusinessObjectProfile
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
     * @var string $entityType
     */
    private $entityType;

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
     * @var Xerias\AssetBookingBundle\Entity\StatusProfile
     */
    private $statusProfile;

    /**
     * @var Xerias\AssetBookingBundle\Entity\BusinessObjectIdGeneratorProfile
     */
    private $idGeneratorProfile;

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
     * Set entityType
     *
     * @param string $entityType
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;
    }

    /**
     * Get entityType
     *
     * @return string $entityType
     */
    public function getEntityType()
    {
        return $this->entityType;
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
     * Set statusProfile
     *
     * @param Xerias\AssetBookingBundle\Entity\StatusProfile $statusProfile
     */
    public function setStatusProfile(\Xerias\AssetBookingBundle\Entity\StatusProfile $statusProfile)
    {
        $this->statusProfile = $statusProfile;
    }

    /**
     * Get statusProfile
     *
     * @return Xerias\AssetBookingBundle\Entity\StatusProfile $statusProfile
     */
    public function getStatusProfile()
    {
        return $this->statusProfile;
    }

    /**
     * Set idGeneratorProfile
     *
     * @param Xerias\AssetBookingBundle\Entity\BusinessObjectIdGeneratorProfile $idGeneratorProfile
     */
    public function setIdGeneratorProfile(\Xerias\AssetBookingBundle\Entity\BusinessObjectIdGeneratorProfile $idGeneratorProfile)
    {
        $this->idGeneratorProfile = $idGeneratorProfile;
    }

    /**
     * Get idGeneratorProfile
     *
     * @return Xerias\AssetBookingBundle\Entity\BusinessObjectIdGeneratorProfile $idGeneratorProfile
     */
    public function getIdGeneratorProfile()
    {
        return $this->idGeneratorProfile;
    }
}