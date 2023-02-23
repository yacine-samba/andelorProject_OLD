<?php

namespace App\Controller;

use App\Entity\User;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {

        $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        return $this->render('user/users.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users,
        ]);
    }
    #[Route('/user/create', name: 'create_user')]
    public function createUser(EntityManagerInterface $entityManager): Response
    {

        $user = new User();
        $user->setEmail('ysambamezaache@gmail.com');
        $user->setPassword('motdepasse');
        $user->setTelephone('0614317060');
        $user->setFirstName('Yacine');
        $user->setLastName('Samba');

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('User created successfully');
    }
}
