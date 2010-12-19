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

           //Get our mighty villa

            $villaAsset = $em->getRepository('Application\AssetBookingBundle\Entity\Asset')
                   ->findOneBy(array('name' => 'villa'));

            //We are going to book it for the weekend
            $weekendPeriodType = $em->getRepository('Application\AssetBookingBundle\Entity\AssetPeriodType')
                            ->findOneBy(array('name' => 'weekend'));

            $checkInDate = \DateTime::createFromFormat('Y-m-d', '2011-01-07');

            
            //Create a new booking item and attach the asset to it
            $bookingItem = new BookingItem();
            $bookingItem->setAsset($villaAsset);
            $bookingItem->setCheckInDate($checkInDate);
            $booking->addItem($bookingItem);

            //Determine all prices (net_value, discount, total_excl_vat, total_incl_vat )
			$prices = $boPricingService->getPricesForEntity(
                        $villaAsset,
                        array('discount_rate'             => 10,
                              'vat_rate'                  => 21,
                              'asset_booking_period_type' => $weekendPeriodType,
                              'asset_booking_check_in_date' => $checkInDate));

            //Todo: store prices
        	var_dump($prices);
            
            $boProfileService->save($booking);
            //$em->flush();

        }else{
            echo 'error';
        }
        //echo $statusManagementService->getStatusProfile('booking_default');

	
        return $this->render('AssetBookingBundle:Dashboard:index.twig', array('name' => 'z'));

    }


}
