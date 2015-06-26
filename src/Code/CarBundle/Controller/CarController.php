<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Code\CarBundle\Entity\Fabricante;
use Code\CarBundle\Entity\Carro;

class CarController extends Controller
{
    /**
     * @Route("/car")
     * @Template()
     */
    public function indexAction()
    {
        return [
            'carrosMarcasModelo' =>[
                ['marca'=>'Volkswagen',
                'modelos'=>[
                    'Gol',
                    'Fox',
                    'Golf',
                    'Saveiro',
                    'Voyage',
                    'Jetta']],
                ['marca'=>'Ford',
                'modelos'=>[
                    'Ecosport',
                    'Ranger',
                    'Fiesta',
                    'Ka',
                    'Fusion',
                    'Focus']],
                ['marca'=>'BMW',
                    'modelos'=>[
                        'Série 3',
                        'X1',
                        'X5',
                        'Serie1',
                        'Z4 Roadster',
                        'X3']]
                ]
            ];
    }
    /**
     * @Route("/car/populate")
     * @Template()
     */
    public function populateAction()
    {
        
//        $dados = [
//            'carrosMarcasModelo' =>[
//                ['marca'=>'Volkswagen',
//                'modelos'=>[
//                    'Gol',
//                    'Fox',
//                    'Golf',
//                    'Saveiro',
//                    'Voyage',
//                    'Jetta']],
//                ['marca'=>'Ford',
//                'modelos'=>[
//                    'Ecosport',
//                    'Ranger',
//                    'Fiesta',
//                    'Ka',
//                    'Fusion',
//                    'Focus']],
//                ['marca'=>'BMW',
//                    'modelos'=>[
//                        'Série 3',
//                        'X1',
//                        'X5',
//                        'Serie1',
//                        'Z4 Roadster',
//                        'X3']]
//                ]
//            ];
            $em= $this->getDoctrine()->getManager();
//            
//            //Trunca os dados das tabelas
//            $connection = $em->getConnection();
//            $platform   = $connection->getDatabasePlatform();
//            //devido ao vinculo de carro e fabricante devemos desativar a verificação de foreign_key para truncar as tabelas carro e fabricante            
//            $connection->query('SET FOREIGN_KEY_CHECKS=0');
//            $connection->executeUpdate($platform->getTruncateTableSQL('Carro', true /* whether to cascade */));
//            $connection->executeUpdate($platform->getTruncateTableSQL('Fabricante', true /* whether to cascade */));
//            $connection->query('SET FOREIGN_KEY_CHECKS=1');            
//            
//            foreach ($dados['carrosMarcasModelo'] as $carrosMarcasModelo) {
//                $fabricante = new Fabricante();
//                $fabricante->setNome($carrosMarcasModelo['marca']);
//                
//                foreach ($carrosMarcasModelo['modelos'] as $modelo) {
//                    $carro = new Carro();
//                    $carro->setModelo($modelo);
//                    //o relacionamento é feito ao setar o fabricante
//                    $carro->setFabricante($fabricante);
//                    
//                    $carro->setAno(2015);
//                    $carro->setCor('Branco');
//                    $em->persist($fabricante);
//                    $em->persist($carro);
//                    $em->flush();                    
//                }
//            }
            
            //Acesso aos dados
            $repoFabrica = $em->getRepository("Code\CarBundle\Entity\Fabricante");
            //$repoCarro = $em->getRepository("Code\CarBundle\Entity\Carro");
            $fabricantes = $repoFabrica->findAll();
            //$fabricantes = $repoFabrica->find(1);
            //$carros = $repoCarro->findAll();
            
            $dadosRetorno = [];
            //$dadosRetorno['carros'] = $carros;
            $dadosRetorno['fabricantes'] = $fabricantes;
            //var_dump($dadosRetorno);die();
        return $dadosRetorno;

        
    }
}
