<?php
namespace Application\AssetBookingBundle\Pricing;

class PricingContextContainer {

    protected $entities;
    protected $data;

    public function PricingContainer(){
        $this->entities = array();
        $this->data = array();
    }
	
	public function addEntity(&$entity){
		$this->entities[] = $entity;
	}
	
    public function getEntities(){
        return $this->entities;
    }
	

    public function setEntities($entities){
        $this->entities = $entities;
    }
    
    public function get($key){
        if(array_key_exist($key, $this->data)){
            return $this->data[$key];
        }
    }

    public function set($key, $value){
        $this->data[$key] = $value;
    }

    public function getContainerData(){
        return $this->data;
    }
}
