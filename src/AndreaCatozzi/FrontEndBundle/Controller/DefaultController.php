<?php

namespace AndreaCatozzi\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AndreaCatozziFrontEndBundle:Default:index.html.twig');
    }

    public function biographyAction()
    {
        return $this->render('AndreaCatozziFrontEndBundle:Default:biography.html.twig');
    }

    public function contactAction()
    {
        return $this->render('AndreaCatozziFrontEndBundle:Default:contact.html.twig');
    }

    public function picturesAction()
    {
        return $this->render('AndreaCatozziFrontEndBundle:Default:pictures.html.twig');
    }

    public function videosAction()
    {
        return $this->render('AndreaCatozziFrontEndBundle:Default:videos.html.twig');
    }
}
