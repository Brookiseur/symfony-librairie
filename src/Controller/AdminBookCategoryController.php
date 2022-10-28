<?php

namespace App\Controller;

use App\Entity\BookCategory;
use App\Form\BookCategoryType;
use App\Repository\BookCategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/book/category')]
class AdminBookCategoryController extends AbstractController
{
    #[Route('/', name: 'app_admin_book_category_index', methods: ['GET'])]
    public function index(BookCategoryRepository $bookCategoryRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $query = $bookCategoryRepository->findBy([], ["id"=>"DESC"]);
        $bookCategories = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        4 /*limit per page*/
        );
        return $this->render('admin_book_category/index.html.twig', [
            'book_categories' => $bookCategories,
        ]);
    }

    #[Route('/new', name: 'app_admin_book_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BookCategoryRepository $bookCategoryRepository): Response
    {
        $bookCategory = new BookCategory();
        $form = $this->createForm(BookCategoryType::class, $bookCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookCategoryRepository->save($bookCategory, true);

            return $this->redirectToRoute('app_admin_book_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_book_category/new.html.twig', [
            'book_category' => $bookCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_book_category_show', methods: ['GET'])]
    public function show(BookCategory $bookCategory): Response
    {
        return $this->render('admin_book_category/show.html.twig', [
            'book_category' => $bookCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_book_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BookCategory $bookCategory, BookCategoryRepository $bookCategoryRepository): Response
    {
        $form = $this->createForm(BookCategoryType::class, $bookCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookCategoryRepository->save($bookCategory, true);

            return $this->redirectToRoute('app_admin_book_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_book_category/edit.html.twig', [
            'book_category' => $bookCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_book_category_delete', methods: ['POST'])]
    public function delete(Request $request, BookCategory $bookCategory, BookCategoryRepository $bookCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bookCategory->getId(), $request->request->get('_token'))) {
            $bookCategoryRepository->remove($bookCategory, true);
        }

        return $this->redirectToRoute('app_admin_book_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
