<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/books", name="books_get")
     */
    public function list(BookRepository $bookRepository) {
        $books = $bookRepository -> findAll();
        $booksAsArray = [];
        foreach($books as $book) {
            $booksAsArray[] = [
                'id' => $book -> getId(),
                'title' => $book -> getTitle()
            ];
        }
        $response = new JsonResponse();
        $response -> setData([
            'success' => true,
            'data' => $booksAsArray
        ]);
        return $response;
    }

    //Inyectamos el servicio entitymanager para poder utilizarlo

    /**
     * @Route("/book/create", name="create_book")
     */
    public function createBook(Request $request, EntityManagerInterface $em) {
        $title = $request -> get('title', null);
        $response = new JsonResponse();
        if (empty($title)) {
            $response -> setData([
                'success' => false,
                'error' => 'Tittle cannot be empty',
                'data' => null
            ]);
            return $response;
        }
        $book = new Book();
        $book -> setTitle($title);
        $em -> persist($book);
        $em -> flush();
        $response -> setData([
            'success' => true,
            'data' => [
                [
                    'id' => $book -> getId(),
                    'title' => $book -> getTitle()
                ]
            ]
        ]);
        return $response;
    }

}
