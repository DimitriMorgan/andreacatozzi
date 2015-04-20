<?php

namespace AndreaCatozzi\BackOfficeBundle\Controller\Media;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AndreaCatozzi\BackOfficeBundle\Entity\Media\Video;
use AndreaCatozzi\BackOfficeBundle\Form\Media\VideoType;

/**
 * Media\Video controller.
 *
 * @Route("/admin/videos")
 */
class VideoController extends Controller
{

    /**
     * Lists all Media\Video entities.
     *
     * @Route("/", name="admin_videos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Video')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Media\Video entity.
     *
     * @Route("/", name="admin_videos_create")
     * @Method("POST")
     * @Template("AndreaCatozziBackOfficeBundle:Media\Video:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Video();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Video')->findAll();

            $entity->setCreatedAt(new \DateTime('now'));
            $entity->setUpdatedAt(new \DateTime("now"));
            $entity->setPosition(count($entities) . + 1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_videos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Media\Video entity.
     *
     * @param Video $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Video $entity)
    {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('admin_videos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Media\Video entity.
     *
     * @Route("/new", name="admin_videos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Video();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Media\Video entity.
     *
     * @Route("/{id}", name="admin_videos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media\Video entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Media\Video entity.
     *
     * @Route("/{id}/edit", name="admin_videos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media\Video entity.');
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
    * Creates a form to edit a Media\Video entity.
    *
    * @param Video $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Video $entity)
    {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('admin_videos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Media\Video entity.
     *
     * @Route("/{id}", name="admin_videos_update")
     * @Method("PUT")
     * @Template("AndreaCatozziBackOfficeBundle:Media\Video:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Media\Video entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_videos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Media\Video entity.
     *
     * @Route("/{id}", name="admin_videos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AndreaCatozziBackOfficeBundle:Media\Video')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Media\Video entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_videos'));
    }

    /**
     * Creates a form to delete a Media\Video entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_videos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
