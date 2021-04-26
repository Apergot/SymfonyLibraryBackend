<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request};
use Symfony\Component\Routing\Annotation\Route;

//para acceder a todos los servicios que nos ofrece symfony bin/console debug:container

class LibraryController extends AbstractController{
    /** 
     * private $logger
     * 
     * estamos creando un bean rofl que se mete en un container para utilizarlo 
     * tenemos dos formar de realizar la inyección de dependencias, aquí en el constructor
     * como se puede observar, y la otra gracias a la última sección del services.yaml que 
     * se puede realizar directamente pasando los "beans" como argumento a las funciones.
    
    * public function __construct(LoggerInterface $logger)
    * {
    *    $this -> logger = $logger;
    * }
    */

    /**
     * @Route("/library/list", name="library_list")
     */
    public function list(Request $request, LoggerInterface $logger) {

        $title = $request -> get('title', 'Título por defecto');
        $logger -> info('GET library_list');
        $response = new JsonResponse();
        $response -> setData([
            'success' => true,
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Hacia rutas salvajes'
                ],
                [
                    'id' => 2,
                    'title' => 'El nombre del viento'
                ],
                [
                    'id' => 3,
                    'title' => $title
                ]
            ]
        ]);
        return $response;
    }

}
