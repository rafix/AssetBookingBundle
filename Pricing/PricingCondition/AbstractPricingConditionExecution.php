<?php

 abstract class AbstractPricingConditionExecution {

   abstract public function AbstractPricingConditionExecution($pricingCondition, $pricingContainer, $serviceContainer);
   abstract public function execute();

}
