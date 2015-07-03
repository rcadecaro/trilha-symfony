<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Code\CarBundle\Entity\Fabricante;
use Code\CarBundle\Entity\Carro;
/**
 * @Route("/car")
 */
class CarController extends Controller
{
    /**
     * @Route("/", name="car_index")
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
     * @Route("/populate/", name="car_populate")
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
            
            $connection = $em->getConnection();
            $platform   = $connection->getDatabasePlatform();

            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $connection->executeUpdate($platform->getTruncateTableSQL('Carro', true));
            $connection->executeUpdate($platform->getTruncateTableSQL('Fabricante', true));
            $connection->query('SET FOREIGN_KEY_CHECKS=1');            
            
            foreach ($dados['carrosMarcasModelo'] as $carrosMarcasModelo) {
                $fabricante = new Fabricante();
                $fabricante->setNome($carrosMarcasModelo['marca']);
                
                foreach ($carrosMarcasModelo['modelos'] as $modelo) {
                    $carro = new Carro();
                    $carro->setModelo($modelo);
                    $carro->setFabricante($fabricante);
                    
                    $carro->setAno(2015);
                    $carro->setCor('Azul');
                    $em->persist($fabricante);
                    $em->persist($carro);
                    $em->flush();                    
                }
            }
            
        return $this->redirect($this->generateUrl('car_list'));

        
    }
    /**
     * @Route("/list", name="car_list")
     * @Template()
     */
    public function listAction()
    {

        $em= $this->getDoctrine()->getManager();
            
        $repoFabrica = $em->getRepository("Code\CarBundle\Entity\Fabricante");
        $fabricantes = $repoFabrica->findAll();
        $dadosRetorno = [];
        $dadosRetorno['fabricantes'] = $fabricantes;

        return $dadosRetorno;

        
    }
}
