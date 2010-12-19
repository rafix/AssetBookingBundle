<?php

namespace Application\AssetBookingBundle\Pricing\PricingCondition;

use Application\AssetBookingBundle\Pricing\PricingCondition\AbstractPricingConditionExecution;

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

       $periodType = $this->pricingContextContainer->get('asset_booking_period_type');
       $periodFrom = $this->pricingContextContainer->get('asset_booking_period_from');

    

       $q = $em->createQuery('SELECT aptp,apt FROM Application\AssetBookingBundle\Entity\AssetPeriodTypePrice aptp ' .
                             ' JOIN aptp.assetPeriodType apt ' .
                             ' WHERE apt.id = ' . $periodType . ' AND aptp.asset = ' . $asset->getId());
       $assetPeriodTypePrice = $q->getSingleResult();

        if($assetPeriodTypePrice){

            $this->pricingContextContainer->set('net_value', $assetPeriodTypePrice->getPrice());
        }


      //Dimension 2: requested period
            

   }

}
