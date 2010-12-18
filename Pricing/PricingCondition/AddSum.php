<?php

namespace Application\AssetBookingBundle\Pricing\PricingCondition;

use Application\AssetBookingBundle\Pricing\PricingCondition\AbstractPricingConditionExecution;

 class AddSum extends AbstractPricingConditionExecution {

   public function execute(){

        $total = 0;

        
        foreach($this->getParameter('source') as $sourceField => $operator){

            $value = $this->pricingContextContainer->get($sourceField);
            switch($operator){
                case '+': $total += $value; break;
                case '-': $total -= $value; break;

            }
        }
        $this->pricingContextContainer->set(
                        $this->getParameter('target'),
                        $total);

		
   }

}
