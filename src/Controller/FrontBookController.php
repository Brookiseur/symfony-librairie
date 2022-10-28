<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\BookCategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontBookController extends AbstractController
{
    #[Route('/livres', name: 'app_front_book')]
    public function index(BookCategoryRepository $bookCategoryRepository): Response
    {
        $categories = $bookCategoryRepository->findBy([], ["title"=>"ASC"]);
        return $this->render('front_book/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    #[Route('/categorie/{id}', name: 'app_front_category_show')]
    public function showCategory(BookCategoryRepository $bookCategoryRepository, $id): Response
    {
        return  $this->render('front_book/category.html.twig',[
            'category'=>$bookCategoryRepository->find($id),
        ]);
    }
    #[Route('/livre/{slug}', name: 'app_front_book_show')]
    public function showBook(BookRepository $bookRepository, $slug): Response
    {
        return  $this->render('front_book/book.html.twig', [
            'book'=>$bookRepository->findOneBy(["slug"=>$slug])
        ]);
    }
}
