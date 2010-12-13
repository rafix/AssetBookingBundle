<?php
namespace Application\AssetBookingBundle\Service;


class BusinessObjectProfileManager {

    protected $container;
    
    public function setContainer($container){
        $this->container = $container;
    }
/**
    public function getBusinessProfileForEntity($entity){

        $em = $this->container->get('doctrine.orm.entity_manager');
        $businessObjectProfileService = $this->container->get('erp.core.customization.business_object_profile_manager');


       //Retrieve business object profile for the entity

        $boProfile = $businessObjectProfileService->getProfilentity($entity);

        //The business object profile knows what statuses we do have
        $statusProfile = $boProfile->getStatusProfile();

        return $statusProfile->getAvailableStatuseForEntity($entity);

    }
*/
    
    public function createBusinessObject($name){

        $em = $this->container->get('doctrine.orm.entity_manager');
        $statusProfileManager = $this->container->get('erp.core.customization.status_profile_manager');


        $entity = null;
        $entityType = null;

        //Find the business object profile for given name
        $businessObjectProfile = $em->getRepository('Application\AssetBookingBundle\Entity\BusinessObjectProfile')
                   ->findOneBy(array('name' => $name));

        //The business object profile knows the real entity type
        if($businessObjectProfile){
            $entityType = $businessObjectProfile->getEntityType();

            $entity = new $entityType();
            $entity->setBusinessObjectProfile($businessObjectProfile);

            //If status profile is defined, determine initial status
            if($statusProfile = $businessObjectProfile->getStatusProfile()){


            }



        }
        
        
        return $entity;

    }

}
