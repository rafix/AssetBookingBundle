<?php
namespace Application\AssetBookingBundle\IdGenerator;

interface IdGeneratorInterface{

    /**
     * Lock a given entity type to create an unique id
     */
    public function lock($entityType);

    /**
      * Lock a given entity type to create an unique id
      */
     public function unlock($entityType);

    /**
      * Lock a given entity type to create an unique id
      */
     public function generate( );


}