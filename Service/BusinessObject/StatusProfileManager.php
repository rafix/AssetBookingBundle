<?php
namespace  Xerias\AssetBookingBundle\Service\BusinessObject;


class StatusProfileManager {

    protected $container;

    public function setContainer($container){
        $this->container = $container;
    }

    public function getAvailableStatusesForEntity($entity){

        $businessObjectProfileManager = $this->container['erp.core.customization.business_object_profile_manager'];
        
       //Retrieve business object profile for the entity
        $boProfile = $businessObjectProfileManager->getProfileForEntity($entity);

        //The business object profile knows the status schema
        $statusProfile = $boProfile->getStatusProfile();

        //The status schema gives us what our available statuses
        return $statusProfile->getAvailableStatusesForEntity($entity);
    }
}
