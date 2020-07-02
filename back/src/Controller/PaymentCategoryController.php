<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PaymentCategoryRepository;

class PaymentCategoryController extends AbstractController
{
    private $repository;

    public function __construct(PaymentCategoryRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @Route("/payment/category", name="payment_category")
     */
    public function index()
    {
        return $this->render('payment_category/index.html.twig', [
            'controller_name' => 'PaymentCategoryController',
        ]);
    }

    /**
     * @Route("/categories", name="categories", methods={"GET"})
     */
    public function getAllCategories()
    {
        return $this->json($this->repository->findAll());
    }
}
