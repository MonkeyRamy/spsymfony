<?php

namespace App\Controller;

use App\Entity\PaymentCategory;
use App\Form\PaymentCategoryType;
use App\Repository\PaymentCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/payment/category")
 */
class PaymentCategoryController extends AbstractController
{
    private $repository;

    public function __construct(PaymentCategoryRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @Route("/categories", name="categories", methods={"GET"})
     */
    public function getAllCategories()
    {
        return $this->json($this->repository->findAll());
    }
    
    /**
     * @Route("/", name="payment_category_index", methods={"GET"})
     */
    public function index(PaymentCategoryRepository $paymentCategoryRepository): Response
    {
        return $this->render('payment_category/index.html.twig', [
            'payment_categories' => $paymentCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="payment_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $paymentCategory = new PaymentCategory();
        $form = $this->createForm(PaymentCategoryType::class, $paymentCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paymentCategory);
            $entityManager->flush();

            return $this->redirectToRoute('payment_category_index');
        }

        return $this->render('payment_category/new.html.twig', [
            'payment_category' => $paymentCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idpaymentCategory}", name="payment_category_show", methods={"GET"})
     */
    public function show(PaymentCategory $paymentCategory): Response
    {
        return $this->render('payment_category/show.html.twig', [
            'payment_category' => $paymentCategory,
        ]);
    }

    /**
     * @Route("/{idpaymentCategory}/edit", name="payment_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PaymentCategory $paymentCategory): Response
    {
        $form = $this->createForm(PaymentCategoryType::class, $paymentCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('payment_category_index');
        }

        return $this->render('payment_category/edit.html.twig', [
            'payment_category' => $paymentCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idpaymentCategory}", name="payment_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PaymentCategory $paymentCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paymentCategory->getIdpaymentCategory(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($paymentCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('payment_category_index');
    }
}
