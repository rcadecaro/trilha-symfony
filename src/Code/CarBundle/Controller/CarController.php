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
        
        $dados = [
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
            $em= $this->getDoctrine()->getManager();
            
//            //Trunca os dados das tabelas
//            $connection = $em->getConnection();
//            $platform   = $connection->getDatabasePlatform();
//            $connection->executeUpdate($platform->getTruncateTableSQL('Fabricante', true /* whether to cascade */));
//            $connection->executeUpdate($platform->getTruncateTableSQL('Carro', true /* whether to cascade */));

            foreach ($dados['carrosMarcasModelo'] as $carrosMarcasModelo) {
                $fabricante = new Fabricante();
                $fabricante->setNome($carrosMarcasModelo['marca']);
                
                $em->persist($fabricante);
                $em->flush();
                foreach ($carrosMarcasModelo['modelos'] as $modelo) {
                    $carro = new Carro();
                    $carro->setModelo($modelo);
                    
                    $em->persist($carro);
                    $em->flush();                    
                }
            }
        
        return $dados;

        
    }
}
