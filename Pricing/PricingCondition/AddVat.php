<?php

namespace Application\AssetBookingBundle\Pricing\PricingCondition;

use Application\AssetBookingBundle\Pricing\PricingCondition\AbstractPricingConditionExecution;

 class AddVat extends AbstractPricingConditionExecution {

   public function execute(){

       $vatRate = $this->pricingContextContainer->get('vat_rate');

       if($vatRate && $vatRate > 0){

           $value =  $this->pricingContextContainer->get($this->getParameter('source'));
           $value = $value / 100 *  $vatRate;
           $this->pricingContextContainer->set(
                $this->getParameter('target'), $value);
       }
		
   }

}
