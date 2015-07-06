<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Code\CarBundle\Entity\Fabricante;
use Code\CarBundle\Service\FabricanteService;
use Code\CarBundle\Form\FabricanteType;

/**
 * @Route("/fabricante")
 */
class FabricanteController extends Controller
{
    private function checkAuth(){
        $securityContext = $this->get('security.context');
        if(!$securityContext->isGranted('ROLE_ADMIN')){
            throw new AccessDeniedException('Somente admins podem acessar.');
        }        
    }
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
        $this->checkAuth();
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
        $this->checkAuth();
        $entity = new Fabricante();
        $form = $this->createForm(new FabricanteType(), $entity);
        $form->bind($request);
        if($form->isValid()){
            
            
            $fabricanteService = $this->get("code_car.service.fabricante");
            
            $entity = $fabricanteService->save($entity);
            
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
        $this->checkAuth();
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
        $this->checkAuth();
        $em=$this->getDoctrine()->getManager();
        $entity = $em->getRepository("Code\CarBundle\Entity\Fabricante")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Registro Não Encontrado!");
        }
        $form = $this->createForm(new FabricanteType(), $entity);
        $form->bind($request);
        if($form->isValid()){
            $fabricanteService = $this->get("code_car.service.fabricante");
            $entity = $fabricanteService->save($entity);

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
        $this->checkAuth();
        $em=$this->getDoctrine()->getManager();
        $entity = $em->getRepository("Code\CarBundle\Entity\Fabricante")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Registro Não Encontrado!");
        }
        $fabricanteService = $this->get("code_car.service.fabricante");

        $entity = $fabricanteService->remove($entity);

        return $this->redirect($this->generateUrl('fabricante_index'));
    }
    
}
