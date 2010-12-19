<?php

namespace Application\AssetBookingBundle\Pricing\PricingConditionExecution;


use Application\AssetBookingBundle\Pricing\PricingConditionExecution\AbstractPricingConditionExecution;

 class GetEntityValues extends AbstractPricingConditionExecution {

   public function execute(){
	
		//Copies the requested source fields from the supplied entity into the pricing context container
		$entities = $this->pricingContextContainer->getEntities();
		if(count($entities)> 0){
		
			$entity = $entities[0];
			
			$parameters = unserialize($this->pricingCondition->getParameters());
			foreach($parameters as $source => $target){
				
				$sourceArray = explode('.', $source);
				$sourceEntityField = $sourceArray[1];
				$entityValue = $entity[$sourceEntityField];
				
				$targetArray = explode('.', $target);
				$targetContainerField = $targetArray[1];
				$this->pricingContextContainer->set($targetContainerField, $entityValue);
			}
		
		}
   }

}
