<?php

namespace AndreaCatozzi\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AndreaCatozzi\FrontEndBundle\Entity\contact;
use AndreaCatozzi\FrontEndBundle\Form\contactType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'AndreaCatozziFrontEndBundle:Default:index.html.twig',
            array('background' => 'Actus.jpg'));
    }

    public function biographyAction()
    {
        return $this->render('AndreaCatozziFrontEndBundle:Default:biography.html.twig');
    }

    public function contactAction(Request $request)
    {
        $contact = new contact();
        $form = $this->createForm(new contactType(), $contact);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Hey bro, tu a un nouveau message d\'un visiteur sur ton site !')
                ->setFrom('gauvin.thibaut83@gmail.com')
                ->setTo('arkezis@hotmail.fr')
                ->setBody($this->renderView('AndreaCatozziFrontEndBundle:Default:email.txt.twig', array('contact' => $contact)));

            $message->setContentType("text/html");
            $this->get('mailer')->send($message);

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Votre message à bien été envoyé.')
            ;

            return $this->redirect($this->generateUrl('front_end_contact'));
        }

        return $this->render('AndreaCatozziFrontEndBundle:Default:contact.html.twig', array(
            'form' => $form->createView()
        ));

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
