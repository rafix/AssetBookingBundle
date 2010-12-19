<?php
namespace Application\AssetBookingBundle\Pricing\PricingConditionExecution;

use Exception;

class PricingConditionExecutionException extends Exception {

     public static function missingPricingContextValue($name)
    {
        return new self("The value $name is missing in the pricing context container");
     }

    public static function determinationFailed(&$priceCondition, $reason)
   {
       return new self('Price determination failed in pricing condition ' .  $priceCondition->getName() . '. ' .  $reason);
    }


}
