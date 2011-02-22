<?php

namespace Xerias\AssetBookingBundle\Pricing\PricingConditionExecution;


use Xerias\AssetBookingBundle\Pricing\PricingConditionExecution\AbstractPricingConditionExecution;

 class GetPromotionValues extends AbstractPricingConditionExecution {

   public function execute(){

       $entities = $this->pricingContextContainer->getEntities();
       $entity = $entities[0];
       //$this->pricingContextContainer->set('net_value', 1250);
   }

}
