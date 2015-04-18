<?php

namespace AndreaCatozzi\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AndreaCatozziBackOfficeBundle:Default:index.html.twig');
    }

    public function biographyAction()
    {
        return $this->render('AndreaCatozziBackOfficeBundle:Default:biography.html.twig');
    }

    public function contactAction()
    {
        return $this->render('AndreaCatozziBackOfficeBundle:Default:contact.html.twig');
    }

    public function picturesAction()
    {
        return $this->render('AndreaCatozziBackOfficeBundle:Default:pictures.html.twig');
    }

    public function videosAction()
    {
        return $this->render('AndreaCatozziBackOfficeBundle:Default:videos.html.twig');
    }
}
