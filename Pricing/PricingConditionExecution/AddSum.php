<?php

namespace Xerias\AssetBookingBundle\Pricing\PricingConditionExecution;

use Xerias\AssetBookingBundle\Pricing\PricingConditionExecution\AbstractPricingConditionExecution;

 class AddSum extends AbstractPricingConditionExecution {

   public function execute(){

        $total = 0;

        $evaluation = $this->getParameter('source');
        $variables = str_word_count($evaluation, 1, '_');

        
        foreach($variables as $variable){

            if($variable != '-'){

                $value = $this->pricingContextContainer->get($variable);
                if(!$value){
                    $value = 0;
                }
                $evaluation = str_replace($variable, $value, $evaluation);
            }

        }
        eval('$total=' .  $evaluation . ';');

        $this->pricingContextContainer->set(
                        $this->getParameter('target'),
                        $total);

		
   }

}

