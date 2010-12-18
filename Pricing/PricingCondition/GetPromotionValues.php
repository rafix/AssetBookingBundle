<?php

namespace Application\AssetBookingBundle\Pricing\PricingCondition;

use Application\AssetBookingBundle\Pricing\PricingCondition\AbstractPricingConditionExecution;

 class GetPromotionValues extends AbstractPricingConditionExecution {

   public function execute(){

       $entities = $this->pricingContextContainer->getEntities();
       $entity = $entities[0];
       $this->pricingContextContainer->set('net_value', 1250);
   }

}
