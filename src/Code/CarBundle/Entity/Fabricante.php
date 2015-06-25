<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Code\CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Carro {
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */    
    private $id;
     
    /**
     * @var string
     * 
     * @ORM\Column(name="modelo", type="string", length=255 )
     */    
    private $modelo;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="ano", type="integer")
     */    
    private $ano;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="cor", type="string", length=255 )
     */    
    private $cor;

    public function getId() {
        return $this->id;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getCor() {
        return $this->cor;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
        return $this;
    }

    public function setAno($ano) {
        $this->ano = $ano;
        return $this;
    }

    public function setCor($cor) {
        $this->cor = $cor;
        return $this;
    }




    
    
}
