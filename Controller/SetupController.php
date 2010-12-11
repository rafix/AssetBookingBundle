<?php

namespace Application\AssetBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\AssetBookingBundle\Entity\StatusProfile;
use Application\AssetBookingBundle\Entity\StatusProfileItem;
use Application\AssetBookingBundle\Entity\Status;



class SetupController extends Controller
{
    public function indexAction()
    {
	
	    $this->loadFixtures();	
	
        return $this->render('AssetBookingBundle:Setup:index.twig', array('name' => 'z'));

    }


    protected function loadFixtures(){

         $em = $this->get('doctrine.orm.entity_manager');

        //Create default status profile for a customer booking process

        $statusProfile = new StatusProfile();
        $statusProfile->setName('Default customer booking status profile');

        $statusesArray = array(
            array('name' => 'Draft'),
            array('name' => 'To be processed'),
            array('name' => 'Waiting for payment'),
            array('name' => 'Confirmed'),
            array('name' => 'Dispute'),
            array('name' => 'Cancelled by customer'),
            array('name' => 'Cancelled by administration'));

        foreach($statusesArray as $statusArray){
            
           $status = new Status();
           $status->setDescription($statusArray['name']);
           $status->setName($statusArray['name']);
                      $statusProfileItem = new StatusProfileItem();
           $statusProfileItem->setStatus($status);
           $statusProfile->item[] = $statusProfileItem;

        }
     
        $em->persist($statusProfile);
        $em->flush();
        
    }
}
