<?php

namespace App\Controller;

use App\Entity\Dinosaur;
use App\Entity\User;
use App\Form\DinosaurType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\DinosaurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @Route("/favorite")
 */
class FavoriteController extends AbstractController
{

    /**
     * @Route("/", name="favorite_all", methods={"GET"})
     */
    public function getAllFavorite(EntityManagerInterface $em, DinosaurRepository $dinosaurRepository, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $dinosaurs = $user->getDinosaur();

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
     * @Route("/add/{id}", name="favorite_add", methods={"POST"})
     */
    public function addNewFavorite($id, EntityManagerInterface $em, DinosaurRepository $dinosaurRepository, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $dinosaur = $dinosaurRepository->find($id);
        $user->addDinosaur($dinosaur);

        $em->persist($user);
        $em->persist($dinosaur);
        $em->flush();

        return new JsonResponse("Dinosaur has been added");
    }
}
