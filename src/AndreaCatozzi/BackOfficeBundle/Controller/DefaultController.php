<?php

namespace AndreaCatozzi\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
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

    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'AndreaCatozziBackOfficeBundle:Default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => ($error) ? "Identifiants incorrects" : null,
            )
        );
    }

    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }
}
