<?php

namespace Application\AssetBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\AssetBookingBundle\Entity\BookingItem;


class DashboardController extends Controller
{
    public function indexAction()
    {
	    $em = $this->get('doctrine.orm.entity_manager');
        
		$boPricingService = $this->get('erp.core.customization.business_object.pricing_manager');
		$boProfileService = $this->get('erp.core.customization.business_object.profile_manager');
	
		$booking = $boProfileService->create('booking_by_customer');
		
		if($booking){

           //Get asset

            $villaAsset = $em->getRepository('Application\AssetBookingBundle\Entity\Asset')
                   ->findOneBy(array('name' => 'villa'));

            $weekendPeriodType = $em->getRepository('Application\AssetBookingBundle\Entity\AssetPeriodType')
                            ->findOneBy(array('name' => 'weekend'));

            $bookingItem = new BookingItem();
            $bookingItem->setAsset($villaAsset);
            $booking->addItem($bookingItem);
            

			$prices = $boPricingService->getPricesForEntity(
                        $villaAsset,
                        array('discount_rate' => 10,
                              'vat_rate' => 21,
                              'asset_booking_period_type' => $weekendPeriodType->getId(),
                              'asset_booking_period_from' => '07.01.2011'));
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
