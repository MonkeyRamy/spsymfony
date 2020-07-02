<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PaymentMethodRepository;

class PaymentMethodController extends AbstractController
{
    private $repository;

    public function __construct(PaymentMethodRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @Route("/payment/method", name="payment_method")
     */
    public function index()
    {
        return $this->render('payment_method/index.html.twig', [
            'controller_name' => 'PaymentMethodController',
        ]);
    }

    /**
     * @Route("/methods", name="methods", methods={"GET"})
     */
    public function getAllMethods()
    {
        return $this->json($this->repository->findAll());
    }
}
