<?php
namespace Code\CarBundle\Service;


use Code\CarBundle\Entity\FabricanteInterface;
/**
 * Description of ProdutoService
 *
 * @author DEVELOPER
 */
class FabricanteService {
    
    private $em;
    public function __construct(\Doctrine\ORM\EntityManagerInterface $em) {
        $this->em = $em;
    }    
    public function save(FabricanteInterface $entity){
        $em = $this->em;
        $em->persist($entity);
        $em->flush();
        
    }
    public function remove(FabricanteInterface $entity){
        $em = $this->em;
        $em->remove($entity);
        $em->flush();
        
    }
}
 