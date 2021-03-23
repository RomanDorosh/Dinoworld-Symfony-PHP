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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/register")
 */
class RegisterController extends AbstractController
{

    /**
     * @Route("", name="user_register", methods={"GET","POST"})
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder): Response
    {
        $userData = json_decode($request->getContent());
        dump($userData);
        $user = new User;
        $user->setEmail($userData->username);
        $password = $encoder->encodePassword($user, $userData->password);
        $user->setPassword($password);
        $user->setName($userData->name);
        $user->setLastname($userData->lastname);
        $Objecdate = \DateTime::createFromFormat('Y-m-d', $userData->birthdate);
        $user->setBirthDate($Objecdate);

        $em->persist($user);
        $em->flush();



        return new JsonResponse($user);
    }
}
