<?php

namespace Code\CarBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Code\CarBundle\Entity\Carro;
use Code\CarBundle\Form\CarroType;

/**
 * Carro controller.
 *
 * @Route("/carro")
 */
class CarroController extends Controller
{

    /**
     * Lists all Carro entities.
     *
     * @Route("/", name="carro")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CodeCarBundle:Carro')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Carro entity.
     *
     * @Route("/", name="carro_create")
     * @Method("POST")
     * @Template("CodeCarBundle:Carro:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Carro();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carro_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Carro entity.
     *
     * @param Carro $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Carro $entity)
    {
        $form = $this->createForm(new CarroType(), $entity, array(
            'action' => $this->generateUrl('carro_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Carro entity.
     *
     * @Route("/new", name="carro_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Carro();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Carro entity.
     *
     * @Route("/{id}", name="carro_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CodeCarBundle:Carro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Carro entity.
     *
     * @Route("/{id}/edit", name="carro_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CodeCarBundle:Carro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carro entity.');
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
    * Creates a form to edit a Carro entity.
    *
    * @param Carro $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Carro $entity)
    {
        $form = $this->createForm(new CarroType(), $entity, array(
            'action' => $this->generateUrl('carro_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Carro entity.
     *
     * @Route("/{id}", name="carro_update")
     * @Method("PUT")
     * @Template("CodeCarBundle:Carro:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CodeCarBundle:Carro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('carro_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Carro entity.
     *
     * @Route("/{id}", name="carro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CodeCarBundle:Carro')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Carro entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('carro'));
    }

    /**
     * Creates a form to delete a Carro entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carro_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
