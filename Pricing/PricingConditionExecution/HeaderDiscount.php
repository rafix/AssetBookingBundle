<?php

namespace Xerias\AssetBookingBundle\Pricing\PricingConditionExecution;


use Xerias\AssetBookingBundle\Pricing\PricingConditionExecution\AbstractPricingConditionExecution;

 class HeaderDiscount extends AbstractPricingConditionExecution {

   public function execute(){

	$discountRate = $this->pricingContextContainer->get('discount_rate');

    if($discountRate && $discountRate > 0 ){

       if($this->getParameter('type') == 'percentage'){

           $value =  $this->pricingContextContainer->get($this->getParameter('source'));
           $value = $value / 100 *  $discountRate;
           $this->pricingContextContainer->set(
                $this->getParameter('target'), $value);
       }
    }

   }

}
