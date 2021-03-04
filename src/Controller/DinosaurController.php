<?php

namespace App\Controller;

use App\Entity\Dinosaur;
use App\Form\DinosaurType;
use App\Repository\DinosaurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dinosaur")
 */
class DinosaurController extends AbstractController
{
    /**
     * @Route("/", name="dinosaur_index", methods={"GET"})
     */
    public function index(DinosaurRepository $dinosaurRepository): Response
    {

        // $dinosaurus = $dinosaurRepository->findAll();
        // print_r($dinosaurus);

        return $this->render('dinosaur/index.html.twig', [
            'dinosaurs' => $dinosaurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dinosaur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dinosaur = new Dinosaur();
        $form = $this->createForm(DinosaurType::class, $dinosaur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dinosaur);
            $entityManager->flush();

            return $this->redirectToRoute('dinosaur_index');
        }

        return $this->render('dinosaur/new.html.twig', [
            'dinosaur' => $dinosaur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dinosaur_show", methods={"GET"})
     */
    public function show(Dinosaur $dinosaur): Response
    {

       

        return $this->render('dinosaur/show.html.twig', [
            'dinosaur' => $dinosaur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dinosaur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dinosaur $dinosaur): Response
    {
        $form = $this->createForm(DinosaurType::class, $dinosaur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dinosaur_index');
        }

        return $this->render('dinosaur/edit.html.twig', [
            'dinosaur' => $dinosaur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dinosaur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dinosaur $dinosaur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dinosaur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dinosaur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dinosaur_index');
    }
}
