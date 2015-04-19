<?php

namespace AndreaCatozzi\BackOfficeBundle\Controller\Media;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AndreaCatozzi\BackOfficeBundle\Entity\Media\Picture;
use AndreaCatozzi\BackOfficeBundle\Form\Media\PictureType;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Media\Picture controller.
 *
 * @Route("/admin/pictures")
 */
class PictureController extends Controller
{

    /**
     * Lists all Media\Picture entities.
     *
     * @Route("/", name="admin_pictures")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Picture')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Media\Picture entity.
     *
     * @Route("/", name="admin_pictures_create")
     * @Method("POST")
     * @Template("AndreaCatozziBackOfficeBundle:Media\Picture:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Picture();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setCreatedAt(new \DateTime('now'));
            $entity->setUpdatedAt(new \DateTime("now"));

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_pictures_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Media\Picture entity.
     *
     * @param Picture $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Picture $entity)
    {
        $form = $this->createForm(new PictureType(), $entity, array(
            'action' => $this->generateUrl('admin_pictures_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Media\Picture entity.
     *
     * @Route("/new", name="admin_pictures_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Picture();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Media\Picture entity.
     *
     * @Route("/{id}", name="admin_pictures_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Picture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media\Picture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Media\Picture entity.
     *
     * @Route("/{id}/edit", name="admin_pictures_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Picture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media\Picture entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Media\Picture entity.
    *
    * @param Picture $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Picture $entity)
    {
        $form = $this->createForm(new PictureType(), $entity, array(
            'action' => $this->generateUrl('admin_pictures_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Media\Picture entity.
     *
     * @Route("/{id}", name="admin_pictures_update")
     * @Method("PUT")
     * @Template("AndreaCatozziBackOfficeBundle:Media\Picture:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Picture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media\Picture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_pictures_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Media\Picture entity.
     *
     * @Route("/{id}", name="admin_pictures_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Picture')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Media\Picture entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_pictures'));
    }

    /**
     * Creates a form to delete a Media\Picture entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_pictures_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
