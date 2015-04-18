<?php

namespace AndreaCatozzi\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AndreaCatozziFrontEndBundle:Default:index.html.twig', array('name' => $name));
    }
}
