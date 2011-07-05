<?php

namespace Sf2gen\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

//annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Main controller containing the menu
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class MainController extends Controller
{   
    /**
     * @Route("/", name="_generator")
     * @Template()
     */
    public function indexAction()
    {        
        return array(
            'message' => $this->get('request')->getSession()->getFlash('notice')
        );
    }
}