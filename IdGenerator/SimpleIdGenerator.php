<?php

namespace Application\AssetBookingBundle\IdGenerator;

class SimpleIdGenerator implements IdGeneratorInterface {


    public function lock($entityType){

    }
    public function unlock($entityType){

    }
    public function generate(){

        return 'WEB-2010-001';
    }
}
