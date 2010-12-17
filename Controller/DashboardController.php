<?php

namespace Application\AssetBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
	    $em = $this->get('doctrine.orm.entity_manager');
        
		$boPricingService = $this->get('erp.core.customization.business_object.pricing_manager');
		$boProfileService = $this->get('erp.core.customization.business_object.profile_manager');
	
		$booking = $boProfileService->create('booking_by_customer');
		
		if($booking){

			$prices = $boPricingService->getPricesForEntity($booking);
        	var_dump($prices);
            //$businessObjectManagementService->saveBusinessObject($booking);
            //$em->flush();

        }else{
            echo 'error';
        }
        //echo $statusManagementService->getStatusProfile('booking_default');

	
        return $this->render('AssetBookingBundle:Dashboard:index.twig', array('name' => 'z'));

    }


}
