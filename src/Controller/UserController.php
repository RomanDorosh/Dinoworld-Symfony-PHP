<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = [];
        $usersEntities = $userRepository->findAll();
        foreach ($usersEntities as $userEntity) {
            $user = [];
            $user["email"] = $userEntity->getEmail();
            $user["name"] = $userEntity->getName();
            $user["lastname"] = $userEntity->getLastname();
            $user["birth_date"] = $userEntity->getBirthDate();
            $user["roles"] = $userEntity->getRoles();
            $user["dinosaur"] = $userEntity->getDinosaur();
            $users[] = $user;
        }

        return new JsonResponse($users);
    }
}
