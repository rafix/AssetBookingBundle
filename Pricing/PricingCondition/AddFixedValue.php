<?php

namespace Application\AssetBookingBundle\Pricing\PricingCondition;

use Application\AssetBookingBundle\Pricing\PricingCondition\AbstractPricingConditionExecution;

 class AddFixedValue extends AbstractPricingConditionExecution {

   public function execute(){

		$parameters = unserialize($this->pricingCondition->getParameters());

		
   }

}
