<?php

namespace Application\AssetBookingBundle\Pricing\PricingCondition;

 abstract class AbstractPricingConditionExecution {

	protected $pricingCondition;
	protected $pricingContextContainer;
	protected $serviceContainer;
	
  	public function AbstractPricingConditionExecution(&$pricingCondition, &$pricingContextContainer, &$serviceContainer){
	
		$this->pricingCondition = $pricingCondition;
		$this->pricingContextContainer = $pricingContextContainer;
		$this->serviceContainer = $serviceContainer;
	
    }

	abstract public function execute();

}
