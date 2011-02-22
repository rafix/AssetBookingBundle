<?php

namespace Xerias\AssetBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Xerias\AssetBookingBundle\Entity\BookingItem;
use Xerias\AssetBookingBundle\Helper\CalendarGrid;

class BookNowController extends Controller
{

    protected $em;



    public function indexAction(){

        $this->em = $this->get('doctrine.orm.entity_manager');

        return $this->showAvailablePeriods();
    }

    public function pricesByWeekAction(){

      
        $this->em = $this->get('doctrine.orm.entity_manager');
        $numberOfWeeks = 52 ;
       // $numberOfWeeks =1;
        $nowDateTime = date('Y-m-d H:i:s');
        $mondayTs =  strtotime ("previous Monday");
        $monday = date('Y-m-d H:i:s', $mondayTs);
        $sundayTs = strtotime('+7 days', $mondayTs) - 1;


        $lastMondayTs = strtotime('+' . $numberOfWeeks . ' weeks', $mondayTs);
        $lastMonday = date('Y-m-d H:i:s', $lastMondayTs);
        


        $asset = $this->getDefaultAsset();

        /** Retrieve all known prices for this asset, ignoring the once falling out of the requested
         *  ]first monday, last monday[ range */
        $qb = $this->em->createQueryBuilder()
                  ->select('aptp')
                  ->from('Xerias\AssetBookingBundle\Entity\AssetPeriodTypePrice', 'aptp')
                  ->innerJoin('aptp.assetPeriodType','apt')
                  ->where('aptp.asset = ?1 and not ( aptp.priceTo < ?2 or aptp.priceFrom > ?3 )');

        $qb->setParameters(array(
             1 => $asset->getId(),
             2 => $monday,
             3 => $lastMonday));

        $assetPeriodTypePrices = $qb->getQuery()->getResult();

        /** Create a price map based on from / to timestamp which make it easier to look up the correct price
         * for a give week */

        $priceMap = array();
        
        foreach($assetPeriodTypePrices as $assetPeriodTypePrice){

            $assetPeriodTypeId = $assetPeriodTypePrice->getAssetPeriodType()->getId();
            if(!array_key_exists($assetPeriodTypeId, $priceMap)){
                $priceMap[$assetPeriodTypeId] = array();
            }

            $priceMap[$assetPeriodTypeId][] = array(
                'priceFrom' => $assetPeriodTypePrice->getPriceFrom()->getTimestamp(),
                'priceTo'   => $assetPeriodTypePrice->getPriceTo()->getTimestamp(),
                'price'     => $assetPeriodTypePrice->getPrice());
                                 

        }


        $assetPricesByWeeks = array();
        $assetPeriodTypes = array();

        //Determine all different period types used
        foreach($assetPeriodTypePrices as $assetPeriodTypePrice){
            $assetPeriodTypes[$assetPeriodTypePrice->getAssetPeriodType()->getId()] =
                    $assetPeriodTypePrice->getAssetPeriodType();
        }

        //Construct the table
        for($i = 1; $i <= $numberOfWeeks; $i++){

            $assetPriceByWeek = array();

            //Generate label (Monday -> Sunday)
            $assetPriceByWeek['label'] =
                    date('d-m', $mondayTs) . ' / ' .
                    date('d-m', $sundayTs) ;

            $assetPriceByWeek['prices'] = array();
            
            //Look up the price for the current period & period type          
            foreach($assetPeriodTypes as $assetPeriodType){

                $price = '';

                foreach($priceMap[$assetPeriodType->getId()] as $priceMapEntry){


                    if($priceMapEntry['priceFrom'] <= $mondayTs &&
                       $priceMapEntry['priceTo'] >= $mondayTs){

                        $price = $priceMapEntry['price'];
                    }
                }
                $assetPriceByWeek['prices'][$assetPeriodType->getId()] = $price;
            }


            $assetPricesByWeeks[] = $assetPriceByWeek;
           
            $mondayTs = strtotime('+7 days', $mondayTs);
            $sundayTs = strtotime('+7 days', $mondayTs) - 1;

        }
        


        return $this->render('AssetBookingBundle:BookNow:pricesByWeek.html.twig',
                             array('assetPricesByWeeks' => $assetPricesByWeeks,
                                   'assetPeriodTypes' => $assetPeriodTypes));
        
    }


    public function getDefaultAsset(){

       $em = $this->get('doctrine.orm.entity_manager');
       return $em->getRepository('Xerias\AssetBookingBundle\Entity\Asset')
                         ->findOneBy(array('name' => 'villa'));

    }
    public function showAvailablePeriods(){

       $em = $this->get('doctrine.orm.entity_manager');

       $asset = $this->getDefaultAsset();
       
	   if(!$asset){
		die('load default configuration');
	   }
       $nowDateTime = date('Y-m-d H:i:s');

       $qb = $em->createQueryBuilder()
                 ->select('aptp')
                 ->from('Xerias\AssetBookingBundle\Entity\AssetPeriodTypePrice', 'aptp')
                 ->innerJoin('aptp.assetPeriodType','apt')
                 ->where('aptp.asset = ?1 and aptp.priceFrom <= ?2 and aptp.priceTo > ?2');

       $qb->setParameters(array(
            1 => $asset->getId(),
            2 => $nowDateTime));

       $assetPeriodTypePrices = $qb->getQuery()->getResult();

       foreach($assetPeriodTypePrices as $assetPeriodTypePrice){
       }


       $calendarGrid = new CalendarGrid();
       $currentMonth = date('m');
       $currentYear = date('Y');

       $calendarGrid->init($currentYear, $currentMonth, 6);

       $firstDay = $calendarGrid->getFirstDay();
       $lastDay = $calendarGrid->getLastDay();

       $gridData =  $calendarGrid->renderGrid();
	
	return $this->render('AssetBookingBundle:BookNow:showAvailablePeriods.html.twig', array('gridData' => $gridData));

    }



    /**
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
     */


}
