<?php

namespace App\Controller;

use App\Entity\BookPage;
use App\Form\BookPageType;
use App\Repository\BookPageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/book-page')]
class AdminBookPageController extends AbstractController
{
    #[Route('/', name: 'app_admin_book_page_index', methods: ['GET'])]
    public function index(BookPageRepository $bookPageRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $bookPageRepository->findBy([], ["id"=>"DESC"]);
        $bookPages = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        4 /*limit per page*/
        );
        return $this->render('admin_book_page/index.html.twig', [
            'book_pages' => $bookPages,
        ]);
    }

    #[Route('/new', name: 'app_admin_book_page_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BookPageRepository $bookPageRepository): Response
    {
        $bookPage = new BookPage();
        $form = $this->createForm(BookPageType::class, $bookPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookPageRepository->save($bookPage, true);

            return $this->redirectToRoute('app_admin_book_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_book_page/new.html.twig', [
            'book_page' => $bookPage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_book_page_show', methods: ['GET'])]
    public function show(BookPage $bookPage): Response
    {
        return $this->render('admin_book_page/show.html.twig', [
            'book_page' => $bookPage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_book_page_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BookPage $bookPage, BookPageRepository $bookPageRepository): Response
    {
        $form = $this->createForm(BookPageType::class, $bookPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookPageRepository->save($bookPage, true);

            return $this->redirectToRoute('app_admin_book_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_book_page/edit.html.twig', [
            'book_page' => $bookPage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_book_page_delete', methods: ['POST'])]
    public function delete(Request $request, BookPage $bookPage, BookPageRepository $bookPageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bookPage->getId(), $request->request->get('_token'))) {
            $bookPageRepository->remove($bookPage, true);
        }

        return $this->redirectToRoute('app_admin_book_page_index', [], Response::HTTP_SEE_OTHER);
    }
}
