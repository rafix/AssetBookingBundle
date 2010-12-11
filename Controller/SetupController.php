<?php

namespace Application\AssetBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SetupController extends Controller
{
    public function indexAction()
    {
	
		
	
        return $this->render('AssetBookingBundle:Setupd:index.twig', array('name' => 'z'));

    }
}
