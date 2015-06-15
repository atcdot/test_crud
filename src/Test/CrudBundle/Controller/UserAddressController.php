<?php

namespace Test\CrudBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Test\CrudBundle\Entity\UserAddress;
use Test\CrudBundle\Form\UserAddressType;

/**
 * UserAddress controller.
 *
 * @Route("/useraddress")
 */
class UserAddressController extends Controller
{

    /**
     * Lists all UserAddress entities.
     *
     * @Route("/", name="useraddress")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TestCrudBundle:UserAddress')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new UserAddress entity.
     *
     * @Route("/", name="useraddress_create")
     * @Method("POST")
     * @Template("TestCrudBundle:UserAddress:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new UserAddress();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('useraddress_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a UserAddress entity.
     *
     * @param UserAddress $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserAddress $entity)
    {
        $form = $this->createForm(new UserAddressType(), $entity, array(
            'action' => $this->generateUrl('useraddress_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserAddress entity.
     *
     * @Route("/new", name="useraddress_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new UserAddress();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a UserAddress entity.
     *
     * @Route("/{id}", name="useraddress_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestCrudBundle:UserAddress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserAddress entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing UserAddress entity.
     *
     * @Route("/{id}/edit", name="useraddress_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestCrudBundle:UserAddress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserAddress entity.');
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
    * Creates a form to edit a UserAddress entity.
    *
    * @param UserAddress $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserAddress $entity)
    {
        $form = $this->createForm(new UserAddressType(), $entity, array(
            'action' => $this->generateUrl('useraddress_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserAddress entity.
     *
     * @Route("/{id}", name="useraddress_update")
     * @Method("PUT")
     * @Template("TestCrudBundle:UserAddress:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestCrudBundle:UserAddress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserAddress entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('useraddress_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a UserAddress entity.
     *
     * @Route("/{id}", name="useraddress_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TestCrudBundle:UserAddress')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserAddress entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('useraddress'));
    }

    /**
     * Creates a form to delete a UserAddress entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('useraddress_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
