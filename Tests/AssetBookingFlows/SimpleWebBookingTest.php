<?php

namespace Application\AssetBookingBundle\Tests\AssetBookingFlows;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Application\AssetBookingBundle\Pricing\PricingContainer;

class SimpleWebBookingTest extends WebTestCase
{

	
	
	public function testCreateNewWebAssetBooking(){
		
		$this->init();
		
		$boPricingService = $this->get('erp.core.customization.business_object.pricing_manager');
		$boProfileService = $this->get('erp.core.customization.business_object.profile_manager');
	
		$booking = $boProfileService->create('booking_by_customer');
		$prices = $boPricingService->getPricesForEntity($booking);
		var_dump($prices);
	}
	
	public function testPricing(){
	
		
		$this->assertTrue(true);
	}
	
	protected function init(){
	
	  $this->client = $this->createClient();
	  $this->container = $this->client->getContainer();
		
	}
	
	protected function get($serviceId){
		return $this->container->get($serviceId);
	}
	
}

