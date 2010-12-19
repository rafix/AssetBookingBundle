<?php
namespace Application\AssetBookingBundle\Service\BusinessObject;

use Application\AssetBookingBundle\Pricing\PricingContextContainer;
use Application\AssetBOokingBundle\Entity\PriceCondition;
use Application\AssetBOokingBundle\Entity\PriceConfiguration;


class PricingManager {

    protected $container;
    
    public function setContainer($container){
        $this->container = $container;
    }


	public function getPricesForEntity($entity, $pricingContextData= array()){
		
		//if(!$pricingContextContainer){
		
			$pricingContextContainer = new PricingContextContainer($pricingContextData);

		
		$pricingContextContainer->addEntity($entity);
	
		return $this->executePriceContextContainer($pricingContextContainer);
	}


    public function determinePriceConfiguration($pricingContextContainer){

        /**  Some advanced determination code should come here one day to determine different pricing schemas
         * based on multiple dimensions such as type of entity, type of customer, ...

         * Following code should be stored in the db some day
         */

        $priceConfiguration = new PriceConfiguration();
        $priceConfiguration->setName('default asset pricing for customers');

        /** The get entity values is normally used for retrieving the net value of a product, service,...

        $priceConditionBaseNetValue = new PriceCondition();
        $priceConditionBaseNetValue->setName('get_entity_values');
        $priceConditionBaseNetValue->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\GetEntityValues');
        //Retrieve entity field 'net_price' and put it in pricing context container node as value 'net_price'
        $priceConditionBaseNetValue->setParameters(serialize(
            array('entity.net_value' => 'container.net_value')));
        */
        $priceConditionBaseNetValue = new PriceCondition();
        $priceConditionBaseNetValue->setName('get_net_value_for_asset');
        $priceConditionBaseNetValue->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\GetNetValueForAsset');
        //Retrieve entity field 'net_price' and put it in pricing context container node as value 'net_price'
        $priceConditionBaseNetValue->setParameters(serialize(
                    array('target' => 'net_value')));


        //Determine promotional prices for specific periods and override the container value
        $priceConditionNetPromotionValue = new PriceCondition();
        $priceConditionNetPromotionValue->setName('get_promotion_values');
        $priceConditionNetPromotionValue->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\GetPromotionValues');
        $priceConditionNetPromotionValue->setParameters(serialize(
            array('source' => 'entity.net_value',
                  'target' => 'net_value')));

        $priceConditionDiscount = new PriceCondition();
        $priceConditionDiscount->setName('add_discount');
        $priceConditionDiscount->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\HeaderDiscount');
        //Retrieve previously stored container.net_value field and put calculations into target container field container.discount
        $priceConditionDiscount->setParameters(serialize(
            array('source'             => 'net_value',
                  'type'               => 'percentage',
                  'target'             => 'discount')));

        $priceConditionAddFee = new PriceCondition();
        $priceConditionAddFee->setName('add_fixed_value');
        $priceConditionAddFee->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\AddFixedValue');
        $priceConditionAddFee->setParameters(serialize(
            array('amount' => 5,
                  'currency' => 'euro',
                  'target' => 'admin_fee')));


        $priceConditionTotalExcl = new PriceCondition();
        $priceConditionTotalExcl->setName('sum_total_excl_vat');
        $priceConditionTotalExcl->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\AddSum');
        $priceConditionTotalExcl->setParameters(serialize(
            array('source' => 'net_value - discount + admin_fee',
                  'target' => 'total_excl_vat')));

        $priceConditionTotalVat = new PriceCondition();
        $priceConditionTotalExcl->setName('add_vat');
        $priceConditionTotalVat->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\AddVat');
        $priceConditionTotalVat->setParameters(serialize(
              array('source'    => 'total_excl_vat',
                    'target'    => 'total_vat')));

        $priceConditionTotal = new PriceCondition();
        $priceConditionTotal->setName('sum_total');
        $priceConditionTotal->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\AddSum');
        $priceConditionTotal->setParameters(serialize(
            array('source' => 'total_excl_vat + total_vat',
                  'target' => 'total_incl_vat')));

        $priceConfiguration->addPriceCondition($priceConditionBaseNetValue);
        $priceConfiguration->addPriceCondition($priceConditionNetPromotionValue);
        $priceConfiguration->addPriceCondition($priceConditionDiscount);
        $priceConfiguration->addPriceCondition($priceConditionAddFee);
        $priceConfiguration->addPriceCondition($priceConditionTotalExcl);
        $priceConfiguration->addPriceCondition($priceConditionTotal);
        
		/**
		//In which sequence should conditions be executed
        $priceConfiguration->setAccessSequence(
            $priceConditionBaseNetValue,
            $priceConditionNetPromotionValue,
            $priceConditionDiscount,
            $priceConditionAddFee,
            $priceConditionTotalExcl,
            $priceConditionTotalVat);
		*/
		return $priceConfiguration;
    }

    protected function executePricingAccessSequence(&$priceConfiguration, &$pricingContextContainer){
		
		//Todo, use access sequence instead of iterating over price conditions collection
        foreach($priceConfiguration->getPriceConditions() as $priceCondition){

            $priceConditionExecutionClassName = $priceCondition->getClass();
		    $priceConditionExecution = new $priceConditionExecutionClassName($priceCondition, $pricingContextContainer, $this->container);
			$priceConditionExecution->execute();
        }

        /**
         * Now the container is enhanced with calculated values
         * It's the initial caller which is responsible for determining which container values are needed.
         * Even better: the full pricing determination could be stored for auditing purposes
         */

    }
	
    protected function executePriceContextContainer(&$priceContextContainer){

        //Determine active pricing configuration

        if($priceConfiguration = $this->determinePriceConfiguration($priceContextContainer)){
			
            $this->executePricingAccessSequence($priceConfiguration, $priceContextContainer);
			
			return $priceContextContainer->getContainerData();
        }
    }
		
}

