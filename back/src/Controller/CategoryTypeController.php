<?php

namespace App\Controller;

use App\Entity\CategoryType;
use App\Form\CategoryTypeType;
use App\Repository\CategoryTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category/type")
 */
class CategoryTypeController extends AbstractController
{
    /**
     * @Route("/", name="category_type_index", methods={"GET"})
     */
    public function index(CategoryTypeRepository $categoryTypeRepository): Response
    {
        return $this->render('category_type/index.html.twig', [
            'category_types' => $categoryTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoryType = new CategoryType();
        $form = $this->createForm(CategoryTypeType::class, $categoryType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoryType);
            $entityManager->flush();

            return $this->redirectToRoute('category_type_index');
        }

        return $this->render('category_type/new.html.twig', [
            'category_type' => $categoryType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcategoryType}", name="category_type_show", methods={"GET"})
     */
    public function show(CategoryType $categoryType): Response
    {
        return $this->render('category_type/show.html.twig', [
            'category_type' => $categoryType,
        ]);
    }

    /**
     * @Route("/{idcategoryType}/edit", name="category_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoryType $categoryType): Response
    {
        $form = $this->createForm(CategoryTypeType::class, $categoryType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_type_index');
        }

        return $this->render('category_type/edit.html.twig', [
            'category_type' => $categoryType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcategoryType}", name="category_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CategoryType $categoryType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryType->getIdcategoryType(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoryType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_type_index');
    }
}
