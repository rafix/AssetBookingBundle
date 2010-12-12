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

         

        //Create a default status profile for a typical customer booking process

        //Several kinds of booking processes can exist together in one system,
        //having their own set of statuses.

        $statusProfile = new StatusProfile();
        $statusProfile->setName('booking_default');
        $statusProfile->setDescription('Default customer booking status profile');
        $statusesArray = array(
            array('name'                => 'Draft',
                  'is_completed'        => false,
                  'is_init'             => true),
            array('name'                => 'Processed',
                  'is_completed'        => false,
                  'is_init'             => true),

            array('name'                => 'To be processed',
                  'is_completed'         => false),
            array('name'                => 'Waiting for payment',
                  'is_completed'         => false),
            array('name'                => 'Confirmed',
                  'is_completed'         => false),
            array('name'                => 'Dispute',
                  'is_completed'         => false),
            array('name'                => 'Cancelled by customer',
                  'is_completed'         => true),
            array('name'                => 'Cancelled by administration',
                  'is_completed'         => true),
            array('name'                => 'Closed',
                  'is_completed'         => true),
                );

        foreach($statusesArray as $statusArray){
            
           $status = new Status();
           $status->setDescription($statusArray['name']);
           $status->setName($statusArray['name']);

           $em->persist($status);
$
           $statusProfileItem = new StatusProfileItem();
           $statusProfileItem->setStatus($status);
           $statusProfileItem->setIsCompleted($statusArray['is_completed']);
           if(array_key_exists('is_init', $statusArray)){
               $statusProfileItem->setIsInit($statusArray['is_init']);
           }
           $statusProfile->addItems($statusProfileItem);

        }
     
        $em->persist($statusProfile);
        $em->flush();
        
    }
}
