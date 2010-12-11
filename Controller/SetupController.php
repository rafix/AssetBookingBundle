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

        //Create default status profile for a customer booking

        $statusProfile = new StatusProfile();
        $statusProfile->setName('Default customer booking status profile');
    
        $status = new Status();
        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($status);

        $statusProfile->item[] = $statusProfileItem;

        
    }
}
