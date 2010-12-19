<?php

namespace Application\AssetBookingBundle\Pricing\PricingConditionExecution;


use Application\AssetBookingBundle\Pricing\PricingConditionExecution\AbstractPricingConditionExecution;
use Application\AssetBookingBundle\Pricing\PricingConditionExecution\PricingConditionExecutionException;

 class GetNetValueForAsset extends AbstractPricingConditionExecution {

   public function execute(){

       /**
        * In a customer booking process for a given asset multiple (period) formules can be available
        * For instance, it can be booked for a a mid week, full week, weekend or long weekend (= period type)
        * Depending on this choice, different prices may be charged for the same asset
        *
        * This particular price condition execution looks for the chosen period period type and updates the
        * net_price field in the service pricing container
        *
        */

       $em = $this->get('doctrine.orm.entity_manager');

       $entities = $this->pricingContextContainer->getEntities();
       $asset = $entities[0];

      //Dimension 1: requested period type
       $periodType = $this->pricingContextContainer->get('asset_booking_period_type', null);

       if(!$periodType){
           throw PricingConditionExecutionException::missingPricingContextValue('asset_booking_period_type');
       }
       
       //Dimension2: start date for booking
       $periodFrom = $this->pricingContextContainer->get('asset_booking_check_in_date');
       if(!$periodFrom){
           throw PricingConditionExecutionException::missingPricingContextValue('asset_booking_check_in_date');
       }

       try{

           $qb = $em->createQueryBuilder()
              ->select('aptp')
              ->from('Application\AssetBookingBundle\Entity\AssetPeriodTypePrice', 'aptp')
              ->innerJoin('aptp.assetPeriodType','apt')
              ->where('apt.id = ?1 and aptp.asset = ?2 and aptp.priceFrom <= ?3 and aptp.priceTo > ?3');

            $qb->setParameters(array(
                1 => $periodType->getId(),
                2 => $asset->getId(),
                3 => $periodFrom->format('Y-m-d H:i:s')));

            if($assetPeriodTypePrice = $qb->getQuery()->getSingleResult()){

                $this->pricingContextContainer->set('net_value', $assetPeriodTypePrice->getPrice());
            }

        }catch( \Doctrine\ORM\NoResultException $exception){
           throw PricingConditionExecutionException::determinationFailed(
                    $this->pricingCondition,
                    'No period pricing found for ' . $periodFrom->format('Y-m-d') .
                    ' for asset ' . $asset->getName() . ' and period type ' . $periodType );


       }
      //Dimension 2: requested period
            

   }

}
