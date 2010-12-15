<?php
/**
 * Created by PhpStorm.
 * User: inspiran
 * Date: 16-dec-2010
 * Time: 0:18:02
 * To change this template use File | Settings | File Templates.
 */
 
class PricingContainer {

    protected $entities;
    protected $data;

    public function PricingContainer(){
        $this->entities = array();
        $this->data = array();
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

    public function getContainer(){
        return $this->data;
    }
}
