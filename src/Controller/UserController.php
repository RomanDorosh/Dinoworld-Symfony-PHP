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



        // return $this->render('user/index.html.twig', [
        //     'users' => $userRepository->findAll(),
        // ]);
    }

    // /**
    //  * @Route("/register", name="user_register", methods={"GET","POST"})
    //  */
    // public function register(Request $request, EntityManagerInteface $em, UserPasswordEncoderInteface $encoder): Response
    // {
    //     $userData = json_decode($request->getContent());
    //     $user = new User;
    //     $user->setEmail($userData->email);
    //     $password=$encoder->encodePassword($user, $userData->password);
    //     $user->setPassword($password);
    //     $user->setName($userData->name);
    //     $user->setLastname($userData->lastname);
    //     $user->setBirthDate($userData->birthdate);

    //     $em->peprsist($user);
    //     $em->flush();



    //     return new JsonResponse($user);
    // }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
