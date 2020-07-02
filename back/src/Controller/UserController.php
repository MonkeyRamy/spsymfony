<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    private $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

    /**
     * @Route("/login", name="login", methods={"GET"})
     */
    public function login(Request $request)
    {
        $login = $request->query->get('login');
        $password = $request->query->get('password');
        return $this->json($this->repository->login($login, $password));
    }
}
