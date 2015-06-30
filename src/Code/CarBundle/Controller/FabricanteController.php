<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Code\CarBundle\Entity\Fabricante;
use Code\CarBundle\Form\FabricanteType;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/fabricante")
 */
class FabricanteController extends Controller
{
    /**
     * @Route("/", name="fabricante_index")
     * @Template()
     */
    public function indexAction()
    {
        $em= $this->getDoctrine()->getManager();
        $repoFabrica = $em->getRepository("Code\CarBundle\Entity\Fabricante");
        $fabricantes = $repoFabrica->findAll();        
        return ['fabricantes'=>$fabricantes];
    }
    /**
     * @Route("/new", name="fabricante_new")
     * @Template()
     */
    public function newAction()
    {   
        $entity = new Fabricante(); 
        $form = $this->createForm(new FabricanteType(), $entity); 
        return [
            'entity'=>$entity,
            'form'=>$form->createView()
        ];
    }
    /**
     * @Route("/create", name="fabricante_create")
     * @Template("CodeCarBundle:Fabricante:new.html.twig")
     */
    public function createAction(Request $request)
    {   
        $entity = new Fabricante();
        $form = $this->createForm(new FabricanteType(), $entity);
        $form->bind($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('fabricante_index'));
        }
        return array(
            'entity'=>$entity,
            'form'=>$form->createView()
        );
    }
    /**
     * @Route("/{id}/edit", name="fabricante_edit")
     * @Template()
     */
    public function editAction($id)
    {   
        $em=$this->getDoctrine()->getManager();
        $entity = $em->getRepository("Code\CarBundle\Entity\Fabricante")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Registro Não Encontrado!");
        }
        $form = $this->createForm(new FabricanteType(), $entity);
        
        return array(
            'entity'=>$entity,
            'form'=>$form->createView()
        );
    }

    /**
     * @Route("{id}/update", name="fabricante_update")
     * @Template("CodeCarBundle:Fabricante:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {   
        $em=$this->getDoctrine()->getManager();
        $entity = $em->getRepository("Code\CarBundle\Entity\Fabricante")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Registro Não Encontrado!");
        }
        $form = $this->createForm(new FabricanteType(), $entity);
        $form->bind($request);
        if($form->isValid()){
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('fabricante_index'));
        }        
        return array(
            'entity'=>$entity,
            'form'=>$form->createView()
        );
    }
    /**
     * @Route("{id}/delete", name="fabricante_delete")
     * @Template()
     */
    public function deleteAction( $id)
    {   
        $em=$this->getDoctrine()->getManager();
        $entity = $em->getRepository("Code\CarBundle\Entity\Fabricante")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Registro Não Encontrado!");
        }
        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('fabricante_index'));
    }
    
}