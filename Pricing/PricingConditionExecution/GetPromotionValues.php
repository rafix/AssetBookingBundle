<?php

namespace Application\AssetBookingBundle\Pricing\PricingConditionExecution;


use Application\AssetBookingBundle\Pricing\PricingConditionExecution\AbstractPricingConditionExecution;

 class GetPromotionValues extends AbstractPricingConditionExecution {

   public function execute(){

       $entities = $this->pricingContextContainer->getEntities();
       $entity = $entities[0];
       //$this->pricingContextContainer->set('net_value', 1250);
   }

}
