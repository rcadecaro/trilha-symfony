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
    public function insert(FabricanteInterface $entity){
        $em = $this->em;
        $em->persist($entity);
        $em->flush();
        
    }
}
 