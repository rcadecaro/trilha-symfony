<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
}
