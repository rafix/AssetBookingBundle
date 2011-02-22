<?php

namespace Xerias\AssetBookingBundle\Pricing\PricingConditionExecution;

    use Xerias\AssetBookingBundle\Pricing\PricingConditionExecution\AbstractPricingConditionExecution;

 class AddFixedValue extends AbstractPricingConditionExecution {

   public function execute(){

		$parameters = unserialize($this->pricingCondition->getParameters());

		
   }

}
