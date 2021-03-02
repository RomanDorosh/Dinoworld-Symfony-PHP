<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class SaludoController extends AbstractController {

    /** 
    *@Route("/hola", name="hola")
    */


    public function index(): Response {
        $name = "Pedro";

        return new Response('<html><body>Hola, ' . $name . '</body></html>');
    }


 /** 
    *@Route("/adios", name="adios")
    */


    public function despido(): Response {
        $name = "Pedro";

        return new Response('<html><body>Adios, ' . $name . '</body></html>');
    }


    /**
     * @Route("/employees/edit/{id}", name="employees_edit", requirements={"id"="\d+"})
     */
    public function edit($id): Response {
        
        return new Response("<html><body>Editando empleado: $id </body></html>");
    }


      /**
     * @Route("/employees/list", name="list")
     */

    public function list(Request $request) {
        $orderby = $request->query->get('orderby', 'name');
        $page = $request->query->get('page', 1);

        $people = [
            ['name' => 'Carlos', 'email' => 'carlos@correo.com', 'age' => 20, 'city' => 'Benalmádena'],
            ['name' => 'Carmen', 'email' => 'carmen@correo.com', 'age' => 15, 'city' => 'Fuengirola'],
            ['name' => 'Carmelo', 'email' => 'carmelo@correo.com', 'age' => 17, 'city' => 'Torremolinos'],
            ['name' => 'Carolina', 'email' => 'carolina@correo.com', 'age' => 18, 'city' => 'Málaga'],
          ]; 
        
        return new JsonResponse($people);

    }




}