<?php
namespace Application\AssetBookingBundle\Service;


class BusinessObjectPricingManager {

    protected $container;
    
    public function setContainer($container){
        $this->container = $container;
    }
/**
    public function getBusinessProfileForEntity($entity){

        $em = $this->container->get('doctrine.orm.entity_manager');
        $businessObjectProfileService = $this->container->get('erp.core.customization.business_object_profile_manager');


       //Retrieve business object profile for the entity

        $boProfile = $businessObjectProfileService->getProfilentity($entity);

        //The business object profile knows what statuses we do have
        $statusProfile = $boProfile->getStatusProfile();

        return $statusProfile->getAvailableStatuseForEntity($entity);

    }
*/

    public function getPrices($pricingContextContainer){

        //Determine active pricing configuration

        if($pricingConfiguration = $this->determinePriceConfiguration($pricingContextContainer)){

            $this->executePricingAccessSequence($pricingConfiguration, $pricingContextContainer);
        }
    }


    public function determinePriceConfiguration($pricingContextContainer){

        /**  Some advanced determination code should come here one day to determine different pricing schemas
         * based on multiple dimensions such as type of entity, type of customer, ...

         * Following code should be stored in the db some day
         */

        $priceConfiguration = new PricingConfiguration();
        $priceConfiguration->setName('default asset pricing for customers');

        $priceConditionBaseNetValue = new PriceCondition();
        $priceConditionBaseNetValue->setName('get_entity_values');

        //Retrieve entity field 'net_price' and put it in pricing context container node as value 'net_price'
        $priceConditionBaseNetValue->setParameters(serialize(
            array('entity.net_value' => 'container.net_value')));
        $priceConditionBaseNetValue->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\GetEntityValues');

        //Determine promotional prices for specific periods and override the container value
        $priceConditionNetPromotionValue = new PriceCondition();
        $priceConditionNetPromotionValue->setName('get_promotion_values');

        $priceConditionNetPromotionValue->setParameters(serialize(
            array('source' => 'entity.net_value',
                  'target' => 'container.net_value')));
        $priceConditionNetPromotionValue->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\GetPromotionValues');

        $priceConditionDiscount = new PriceCondition();
        $priceConditionDiscount->setName('add_discount');

        //Retrieve previously stored container.net_value field and put calculations into target container field container.discount
        $priceConditionDiscount->setParameters(serialize(array('source' => 'container.net_value', 'target' => 'container.discount')));
        $priceConditionDiscount->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\HeaderDiscount');

        $priceConditionAddFee = new PriceCondition();
        $priceConditionAddFee->setName('add_fixed_fee');
        $priceConditionAddFee->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\AddFixedFee');
        $priceConditionAddFee->setParameters(serialize(
            array('amount' => 5,
                  'currency' => 'euro',
                  'target' => 'container.admin_fee')));


        $priceConditionTotalExcl = new PriceCondition();
        $priceConditionTotalExcl->setName('sum_total_excl_vat');
        $priceConditionTotalExcl->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\AddSum');
        $priceConditionTotalExcl->setParameters(serialize(
            array('source' =>
                    array('+' => 'container.net_value',
                          '-' => 'container.discount',
                          '+' => 'container.admin_fee'),
                   'target' => 'container.total_excl_vat')));

        $priceConditionTotalVat = new PriceCondition();
        $priceConditionTotalVat->setClass('Application\AssetBookingBundle\Pricing\PricingCondition\AddVat');
        $priceConditionTotalVat->setParameters(serialize(
              array('source'    => 'container.total_excl_vat',
                    'vat_rate'  => 'container.vat_rate',
                    'target'    => 'container.total_excl_vat')));

        $priceConfiguration->addCondition($priceConditionBaseNetValue);
        $priceConfiguration->addCondition($priceConditionDiscount);
        $priceConfiguration->addCondition($priceConditionAddFee);
        $priceConfiguration->addCondition($priceConditionTotalExcl);
        $priceConfiguration->addCondition($priceConditionTotalVat);

        //In which sequence should conditions be executed
        $priceConfiguration->setAccessSequence(
            $priceConditionBaseNetValue,
            $priceConditionNetPromotionValue,
            $priceConditionDiscount,
            $priceConditionAddFee,
            $priceConditionTotalExcl,
            $priceConditionTotalVat);

    }

    public function executePricingAccessSequence($priceConfiguration, $pricingContextContainer){

        foreach($priceConfiguration->getAccessSequence() as $priceCondition){

            $priceConditionExecutionClassName = $priceCondition->getClass();
            $priceConditionExecution = new $priceConditionExecutionClassName($priceCondition);

            $priceConditionExecution->execute($pricingContextContainer, $this->container);
        }

        /**
         * Now the container is enhanced with calculated values
         * It's the initial caller who is responsible for determining which values are needed.
         * Even more cool: the full determination could be stored together with the asset booking for auditing purposes
         */

    }
}

