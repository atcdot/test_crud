<?php

namespace Test\CrudBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Test\CrudBundle\Entity\UserRoles;
use Test\CrudBundle\Form\UserRolesType;

/**
 * UserRoles controller.
 *
 * @Route("/userroles")
 */
class UserRolesController extends Controller
{

    /**
     * Lists all UserRoles entities.
     *
     * @Route("/", name="userroles")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TestCrudBundle:UserRoles')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new UserRoles entity.
     *
     * @Route("/", name="userroles_create")
     * @Method("POST")
     * @Template("TestCrudBundle:UserRoles:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new UserRoles();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('userroles_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a UserRoles entity.
     *
     * @param UserRoles $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserRoles $entity)
    {
        $form = $this->createForm(new UserRolesType(), $entity, array(
            'action' => $this->generateUrl('userroles_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserRoles entity.
     *
     * @Route("/new", name="userroles_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new UserRoles();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a UserRoles entity.
     *
     * @Route("/{id}", name="userroles_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestCrudBundle:UserRoles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserRoles entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing UserRoles entity.
     *
     * @Route("/{id}/edit", name="userroles_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestCrudBundle:UserRoles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserRoles entity.');
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
    * Creates a form to edit a UserRoles entity.
    *
    * @param UserRoles $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserRoles $entity)
    {
        $form = $this->createForm(new UserRolesType(), $entity, array(
            'action' => $this->generateUrl('userroles_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserRoles entity.
     *
     * @Route("/{id}", name="userroles_update")
     * @Method("PUT")
     * @Template("TestCrudBundle:UserRoles:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestCrudBundle:UserRoles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserRoles entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('userroles_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a UserRoles entity.
     *
     * @Route("/{id}", name="userroles_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TestCrudBundle:UserRoles')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserRoles entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('userroles'));
    }

    /**
     * Creates a form to delete a UserRoles entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userroles_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
