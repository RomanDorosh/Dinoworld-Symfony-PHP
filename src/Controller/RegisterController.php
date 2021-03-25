<?php

namespace App\Controller;

use App\Entity\Dinosaur;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\PeriodRepository;
use App\Repository\ContinentRepository;
use App\Repository\DietRepository;
use App\Repository\DinosaurRepository;
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
     * @Route("/user", name="user_register", methods={"GET","POST"})
     */
    public function registerUser(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder): Response
    {
        $userData = json_decode($request->getContent());
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

    /**
     * @Route("/dinosaur", name="dinosaur_register", methods={"GET","POST"})
     */
    public function registerDinosaur(Request $request, EntityManagerInterface $em, PeriodRepository $periodRepository, DietRepository $dietRepository, ContinentRepository $continentRepository): Response
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


        $dinosaur = new Dinosaur();
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
}
