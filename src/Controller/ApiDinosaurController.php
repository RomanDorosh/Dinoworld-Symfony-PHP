<?php

namespace App\Controller;

use App\Entity\Dinosaur;
use App\Form\DinosaurType;
use App\Repository\DinosaurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/dinosaur")
 */
class ApiDinosaurController extends AbstractController
{
    /**
     * @Route("/", name="api_dinosaur_index", methods={"GET"})
     */
    // public function index(DinosaurRepository $dinosaurRepository): Response
    // {

    //     // $dinosaurus = $dinosaurRepository->findAll();
    //     // print_r($dinosaurus);

    //     return $this->render('dinosaur/index.html.twig', [
    //         'dinosaurs' => $dinosaurRepository->findAll(),
    //     ]);
    // }

    // /**
    //  * @Route("/new", name="api_dinosaur_new", methods={"GET","POST"})
    //  */
    // public function new(Request $request): Response
    // {
    //     $dinosaur = new Dinosaur();
    //     $form = $this->createForm(DinosaurType::class, $dinosaur);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($dinosaur);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('dinosaur_index');
    //     }

    //     return $this->render('dinosaur/new.html.twig', [
    //         'dinosaur' => $dinosaur,
    //         'form' => $form->createView(),
    //     ]);
    // }

    /**
     * @Route("/{id}", name="api_dinosaur_show", methods={"GET"})
     */
    public function show($id, DinosaurRepository $dinosaurRepository): Response
    {

        $dinosaur = $dinosaurRepository->find($id);
        $dinosaurArray = [
            "ID"=>$dinosaur->getId(),
            "name"=>$dinosaur->getName(),
            "period"=>$dinosaur->getPeriod()->getName(),
            "diet"=>$dinosaur->getDiet()->getName(),
            "continent"=>$dinosaur->getContinent()->getName(),
            "weight"=>$dinosaur->getWeight(),
            "height"=>$dinosaur->getHeight(),
            "topSpeed"=>$dinosaur->getTopSpeed(),
            "lenght"=>$dinosaur->getLenght(),
            "img"=>$dinosaur->getImg(),
            "top"=>$dinosaur->getTop()
        ];

        return new JsonResponse($dinosaurArray);
    }

    // /**
    //  * @Route("/{id}/edit", name="api_dinosaur_edit", methods={"GET","POST"})
    //  */
    // public function edit(Request $request, Dinosaur $dinosaur): Response
    // {
    //     $form = $this->createForm(DinosaurType::class, $dinosaur);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('dinosaur_index');
    //     }

    //     return $this->render('dinosaur/edit.html.twig', [
    //         'dinosaur' => $dinosaur,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="api_dinosaur_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, Dinosaur $dinosaur): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$dinosaur->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($dinosaur);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('dinosaur_index');
    // }
}
