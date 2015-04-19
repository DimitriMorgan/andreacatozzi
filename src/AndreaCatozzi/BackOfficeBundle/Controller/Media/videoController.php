<?php

namespace AndreaCatozzi\BackOfficeBundle\Controller\Media;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('AndreaCatozziBackOfficeBundle:Default:index.html.twig');
    }

}
