<?php

namespace Application\AssetBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\AssetBookingBundle\Entity\BusinessObjectProfile;
use Application\AssetBookingBundle\Entity\BusinessObjectIdGeneratorProfile;

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


        //Several kinds of booking processes can exist together in one system.
		//To make a distinction between both processses, we manage metadata for each process in business object profiles
		//A business profile contains meta data such as the status schema, id generators and so on.
		
		//For now we model two processes: customer bookings and agency bookings
		//Customer booking process:  customer selects and books an asset and pays.  Next it's processed by the administration
		//and closed if the stay was pleasent or remains in status 'dispute' if the customer disagrees.
		//Agent booking proces: third party agency books multiple assets without direct payments.  At the end of the month
		//an invoice is sent to the agency for all sold assets
		
        $statusProfileCustomer = new StatusProfile();
        $statusProfileCustomer->setName('booking_customer');
        $statusProfileCustomer->setDescription('Default customer booking status profile');
        $em->persist($statusProfileCustomer);

        $statusProfileAgency = new StatusProfile();
        $statusProfileAgency->setName('booking_agency');
        $statusProfileAgency->setDescription('Status profile for bookings performed by a third party agency');
        $em->persist($statusProfileAgency);

        //Create an specific id generator for the booking customer process (just as an example)
        //Objective is to create sequences 'WEB-2010-0001', 'WEB-2010-0002', ...
        $idGeneratorProfile = new BusinessObjectIdGeneratorProfile();
        $idGeneratorProfile->setName('booking_customer_id_generator');
        $idGeneratorProfile->setClass("\Application\AssetBookingBundle\IdGenerator\SimpleIdGenerator");
        $em->persist($idGeneratorProfile);
		
        //Create the business object profile containing all business object meta data
        $businessObjectProfileCustomer = new BusinessObjectProfile();
        $businessObjectProfileCustomer->setName('booking_by_customer');
        $businessObjectProfileCustomer->setEntityType("\Application\AssetBookingBundle\Entity\Booking");
        $businessObjectProfileCustomer->setStatusProfile($statusProfileCustomer);
        $businessObjectProfileCustomer->setIdGeneratorProfile($idGeneratorProfile);
        $em->persist($businessObjectProfileCustomer);

        $businessObjectProfileAgency = new BusinessObjectProfile();
        $businessObjectProfileAgency->setName('booking_by_agency');
        $businessObjectProfileAgency->setEntityType("\Application\AssetBookingBundle\Entity\Booking");
        $businessObjectProfileAgency->setStatusProfile($statusProfileAgency);

        $em->persist($businessObjectProfileAgency);

        $em->flush();
       
        //Now we still need to create the required statuses.  It can happen that multiple status profiles
        //share the same status.  This should only be the case if the status in both cases the same semantic meaning

        $statusDraft = new Status();
        $statusDraft->setName('Draft');
        $em->persist($statusDraft);

        $statusTbp = new Status();
        $statusTbp->setName('To be processed');
        $em->persist($statusTbp);

        $statusIp = new Status();
        $statusIp->setName('In progress');
        $em->persist($statusIp);

        $statusWfp = new Status();
        $statusWfp->setName('Waiting for payment');
        $em->persist($statusWfp);

        $statusDis = new Status();
        $statusDis->setName('Dispute');
        $em->persist($statusDis);

        $statusCan = new Status();
        $statusCan->setName('Cancelled');
        $em->persist($statusCan);

        $statusCls = new Status();
        $statusCls->setName('Closed');
        $em->persist($statusCls);

        $statusRfb = new Status();
        $statusRfb->setName('Ready for billing');
        $em->persist($statusRfb);

        //Add statuses to the customer booking status profile
        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusDraft);
        $statusProfileItem->setPosition(1);
        $statusProfileItem->setIsInit(true);
        $statusProfileCustomer->addItem($statusProfileItem);

        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusTbp);
        $statusProfileItem->setPosition(2);
        $statusProfileCustomer->addItem($statusProfileItem);

        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusIp);
        $statusProfileItem->setPosition(3);
        $statusProfileCustomer->addItem($statusProfileItem);

        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusDis);
        $statusProfileItem->setPosition(4);
        $statusProfileCustomer->addItem($statusProfileItem);

        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusWfp);
        $statusProfileItem->setPosition(5);
        $statusProfileCustomer->addItem($statusProfileItem);

        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusCan);
        $statusProfileItem->setPosition(6);
        $statusProfileItem->setIsCompleted(true);
        $statusProfileCustomer->addItem($statusProfileItem);

        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusCls);
        $statusProfileItem->setPosition(7);
        $statusProfileItem->setIsCompleted(true);
        $statusProfileCustomer->addItem($statusProfileItem);

        $em->persist($statusProfileCustomer);

         //Add statuses to the customer booking status profile
        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusDraft);
        $statusProfileItem->setPosition(1);
        $statusProfileItem->setIsInit(true);
        $statusProfileAgency->addItem($statusProfileItem);

        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusTbp);
        $statusProfileItem->setPosition(2);
        $statusProfileAgency->addItem($statusProfileItem);

        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusCan);
        $statusProfileItem->setPosition(3);
        $statusProfileItem->setIsCompleted(true);
        $statusProfileAgency->addItem($statusProfileItem);

        $statusProfileItem = new StatusProfileItem();
        $statusProfileItem->setStatus($statusCls);
        $statusProfileItem->setPosition(4);
        $statusProfileItem->setIsCompleted(true);
        $statusProfileAgency->addItem($statusProfileItem);

        $em->persist($statusProfileAgency);
        $em->flush();

    }
}
