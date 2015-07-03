<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Code\CarBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Fabricante implements FabricanteInterface{
    
    public function __construct() {
        $this->carros = new ArrayCollection();
    }
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */    
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Carro", mappedBy="fabricante")
     */    
    private $carros;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="nome", type="string", length=255 )
     */
    private $nome;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }
    public function getCarros() {
        return $this->carros;
    }
    public function __toString() {
        return $this->getNome();
    }
//    public function setCarros($carros) {
//        $this->carros = $carros;
//        return $this;
//    }
    
    
}
