<?php

namespace Application\AssetBookingBundle\Pricing\PricingConditionExecution;

    use Application\AssetBookingBundle\Pricing\PricingConditionExecution\AbstractPricingConditionExecution;

 class AddFixedValue extends AbstractPricingConditionExecution {

   public function execute(){

		$parameters = unserialize($this->pricingCondition->getParameters());

		
   }

}
