<?php

namespace Application\AssetBookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
	
		
	
        return $this->render('AssetBookingBundle:Dashboard:index.twig', array('name' => 'z'));

    }
}
