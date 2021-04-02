<?php

namespace App\Controller;

use App\Entity\Dinosaur;
use App\Form\DinosaurType;
use App\Repository\PeriodRepository;
use App\Repository\ContinentRepository;
use App\Repository\DietRepository;
use App\Repository\DinosaurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @Route("/dinosaur")
 */
class DinosaurController extends AbstractController
{
    /**
     * @Route("/", name="dinosaur_index", methods={"GET"})
     */
    public function getAllDinosaurs(DinosaurRepository $dinosaurRepository): Response
    {
        $dinosaurs = $dinosaurRepository->findAll();

        dump($dinosaurs);


        $dinosaursArr = [];

        foreach ($dinosaurs as $dinosaur) {


            $continent = $dinosaur->getContinent();

            $continetObj = [
                "ID" => $continent->getId(),
                "name" => $continent->getName()
            ];

            $period = $dinosaur->getPeriod();

            $periodObj = [
                "ID" => $period->getId(),
                "name" => $period->getName()
            ];

            $diet = $dinosaur->getDiet();

            $dietObj = [
                "ID" => $diet->getId(),
                "name" => $diet->getName()
            ];

            $usersArr = [];

            $users = $dinosaur->getUsers();

            foreach ($users as $user) {
                $userArr = [
                    "ID" => $user->getId(),
                    "name" => $user->getName(),
                    "lastname" => $user->getLastname(),
                    "birth_date" => $user->getBirthDate(),
                    "email" => $user->getEmail(),
                    "roles" => $user->getRoles(),
                    "password" => $user->getPassword()
                ];
                $usersArr[] = $userArr;
            }

            $dinosaurArr = [
                "ID" => $dinosaur->getId(),
                "name" => $dinosaur->getName(),
                "period" => $periodObj,
                "diet" => $dietObj,
                "continent" => $continetObj,
                "weight" => $dinosaur->getWeight(),
                "height" => $dinosaur->getHeight(),
                "lenght" => $dinosaur->getLenght(),
                "top_speed" => $dinosaur->getTopSpeed(),
                "top" => $dinosaur->getTop(),
                "img" => $dinosaur->getImg(),
                "users" => $usersArr,
                "info" => $dinosaur->getInfo(),
            ];

            $dinosaursArr[] = $dinosaurArr;
        }

        return new JsonResponse($dinosaursArr);
    }

    /**
     * @Route("/sorted", name="dinosaur_sorted_by_name", methods={"GET"})
     */
    public function getAllSortedByNameDinosaurs(DinosaurRepository $dinosaurRepository): Response
    {

        $dinosaurs = $dinosaurRepository->findBy(array(), array('name' => 'ASC'));
        dump($dinosaurs);

        $dinosaursArr = [];

        foreach ($dinosaurs as $dinosaur) {


            $continent = $dinosaur->getContinent();

            $continetObj = [
                "ID" => $continent->getId(),
                "name" => $continent->getName()
            ];

            $period = $dinosaur->getPeriod();

            $periodObj = [
                "ID" => $period->getId(),
                "name" => $period->getName()
            ];

            $diet = $dinosaur->getDiet();

            $dietObj = [
                "ID" => $diet->getId(),
                "name" => $diet->getName()
            ];

            $usersArr = [];

            $users = $dinosaur->getUsers();

            foreach ($users as $user) {
                $userArr = [
                    "ID" => $user->getId(),
                    "name" => $user->getName(),
                    "lastname" => $user->getLastname(),
                    "birth_date" => $user->getBirthDate(),
                    "email" => $user->getEmail(),
                    "roles" => $user->getRoles(),
                    "password" => $user->getPassword()
                ];
                $usersArr[] = $userArr;
            }

            $dinosaurArr = [
                "ID" => $dinosaur->getId(),
                "name" => $dinosaur->getName(),
                "period" => $periodObj,
                "diet" => $dietObj,
                "continent" => $continetObj,
                "weight" => $dinosaur->getWeight(),
                "height" => $dinosaur->getHeight(),
                "lenght" => $dinosaur->getLenght(),
                "top_speed" => $dinosaur->getTopSpeed(),
                "top" => $dinosaur->getTop(),
                "img" => $dinosaur->getImg(),
                "users" => $usersArr,
                "info" => $dinosaur->getInfo(),
            ];

            $dinosaursArr[] = $dinosaurArr;
        }

        return new JsonResponse($dinosaursArr);
    }

    /**
     * @Route("/page{currentPage}", name="dinosaur_index_page", methods={"GET"})
     */
    public function indexPage($currentPage, DinosaurRepository $dinosaurRepository): Response
    {
        // // build the query for the doctrine paginator
        $query = $dinosaurRepository->createQueryBuilder('dinosaur')
            ->orderBy('dinosaur.id', 'ASC')
            ->getQuery();

        //set page size
        $pageSize = '10';

        // load doctrine Paginator
        $dinosaurs = new \Doctrine\ORM\Tools\Pagination\Paginator($query);

        // // you can get total items
        // $totalItems = count($dinosaurs);

        // // get total pages
        // $pagesCount = ceil($totalItems / $pageSize);

        // now get one page's items:
        $dinosaurs
            ->getQuery()
            ->setFirstResult($pageSize * ($currentPage - 1)) // set the offset
            ->setMaxResults($pageSize); // set the limit


        $dinosaursArr = [];

        //Make foreach with the result and return Json response
        foreach ($dinosaurs as $dinosaur) {


            $continent = $dinosaur->getContinent();

            $continetObj = [
                "ID" => $continent->getId(),
                "name" => $continent->getName()
            ];

            $period = $dinosaur->getPeriod();

            $periodObj = [
                "ID" => $period->getId(),
                "name" => $period->getName()
            ];

            $diet = $dinosaur->getDiet();

            $dietObj = [
                "ID" => $diet->getId(),
                "name" => $diet->getName()
            ];

            $usersArr = [];

            $users = $dinosaur->getUsers();

            foreach ($users as $user) {
                $userArr = [
                    "ID" => $user->getId(),
                    "name" => $user->getName(),
                    "lastname" => $user->getLastname(),
                    "birth_date" => $user->getBirthDate(),
                    "email" => $user->getEmail(),
                    "roles" => $user->getRoles(),
                    "password" => $user->getPassword()
                ];
                $usersArr[] = $userArr;
            }

            $dinosaurArr = [
                "ID" => $dinosaur->getId(),
                "name" => $dinosaur->getName(),
                "period" => $periodObj,
                "diet" => $dietObj,
                "continent" => $continetObj,
                "weight" => $dinosaur->getWeight(),
                "height" => $dinosaur->getHeight(),
                "lenght" => $dinosaur->getLenght(),
                "top_speed" => $dinosaur->getTopSpeed(),
                "top" => $dinosaur->getTop(),
                "img" => $dinosaur->getImg(),
                "users" => $usersArr,
                "info" => $dinosaur->getInfo(),
            ];

            $dinosaursArr[] = $dinosaurArr;
        }

        return new JsonResponse($dinosaursArr);
    }

    // /**
    //  * @Route("/new", name="dinosaur_new", methods={"GET","POST"})
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
     * @Route("/{id}", name="dinosaur_show", methods={"GET"})
     */
    public function show($id, DinosaurRepository $dinosaurRepository): Response
    {
        $dinosaur = $dinosaurRepository->find($id);

        if ($dinosaur === null) {
            throw $this->createNotFoundException("The dinosaur does not exist");
        }

        $continent = $dinosaur->getContinent();

        $continetObj = [
            "ID" => $continent->getId(),
            "name" => $continent->getName()
        ];

        $period = $dinosaur->getPeriod();

        $periodObj = [
            "ID" => $period->getId(),
            "name" => $period->getName()
        ];

        $diet = $dinosaur->getDiet();

        $dietObj = [
            "ID" => $diet->getId(),
            "name" => $diet->getName()
        ];

        $usersArr = [];

        $users = $dinosaur->getUsers();

        foreach ($users as $user) {
            $userArr = [
                "ID" => $user->getId(),
                "name" => $user->getName(),
                "lastname" => $user->getLastname(),
                "birth_date" => $user->getBirthDate(),
                "email" => $user->getEmail(),
                "roles" => $user->getRoles(),
                "password" => $user->getPassword()
            ];
            $usersArr[] = $userArr;
        }

        $dinosaurs = [
            "ID" => $dinosaur->getId(),
            "name" => $dinosaur->getName(),
            "period" => $periodObj,
            "diet" => $dietObj,
            "continent" => $continetObj,
            "weight" => $dinosaur->getWeight(),
            "height" => $dinosaur->getHeight(),
            "lenght" => $dinosaur->getLenght(),
            "top_speed" => $dinosaur->getTopSpeed(),
            "top" => $dinosaur->getTop(),
            "img" => $dinosaur->getImg(),
            "users" => $usersArr,
            "info" => $dinosaur->getInfo(),
        ];


        return new JsonResponse($dinosaurs);
    }

    // public function show(Dinosaur $dinosaur): Response
    // {

    //     return $this->render('dinosaur/show.html.twig', [
    //         'dinosaur' => $dinosaur,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}/edit", name="dinosaur_edit", methods={"GET","POST"})
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

    /**
     * @Route("/edit/{id}", name="dinosaur_edit", methods={"GET","POST"})
     */
    public function edit($id, Request $request, Dinosaur $dinosaur, DinosaurRepository $dinosaurRepository, EntityManagerInterface $em, PeriodRepository $periodRepository, DietRepository $dietRepository, ContinentRepository $continentRepository): Response
    {

        $name = $request->request->get("name");
        $periodId = (int) $request->request->get("period");
        $dietId = (int) $request->request->get("diet");
        $continentId = (int) $request->request->get("continent");
        $weight = (int) $request->request->get("weight");
        $height = (int) $request->request->get("height");
        $lenght = (int) $request->request->get("lenght");
        $top_speed = (int) $request->request->get("top_speed");
        $top = (int) $request->request->get("top");
        $info = $request->request->get("info");
        $img = $request->files->get("img");

        // dump($img);

        $directory = '/var/www/html/finalsymfonyproject/public/images';

        $fileName = "$name.jpg";

        $img->move($directory, $fileName);


        $dinosaur = $dinosaurRepository->find($id);
        $dinosaur->setName($name);
        $dinosaur->setPeriod($periodRepository->find($periodId));
        $dinosaur->setDiet($dietRepository->find($dietId));
        $dinosaur->setContinent($continentRepository->find($continentId));
        $dinosaur->setWeight($weight);
        $dinosaur->setHeight($height);
        $dinosaur->setLenght($lenght);
        $dinosaur->setTopSpeed($top_speed);
        $dinosaur->setTop($top);
        $dinosaur->setInfo($info);
        $dinosaur->setImg($fileName);

        $em->persist($dinosaur);
        $em->flush(); //INSERT to Mysql

        return new JsonResponse([]);
    }

    // /**
    //  * @Route("/delete/{id}", name="dinosaur_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, Dinosaur $dinosaur): Response
    // {
    //     if ($this->isCsrfTokenValid('delete' . $dinosaur->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($dinosaur);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('dinosaur_index');
    // }

    /**
     * @Route("/delete/{id}", name="dinosaur_delete", methods={"DELETE"})
     */
    public function delete($id, EntityManagerInterface $em, DinosaurRepository $dinosaurRepository): Response
    {
        $dinosaur = $dinosaurRepository->find($id);

        $em->remove($dinosaur);
        $em->flush();

        return new JsonResponse("Dinosaur ${id} has been delete");
    }
}
