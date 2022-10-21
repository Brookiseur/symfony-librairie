<?php

namespace App\Controller;

use App\Repository\CarouselRepository;
use App\Repository\HomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontHomeController extends AbstractController
{
    #[Route('/', name: 'app_front_home')]
    public function index(HomeRepository $homeRepository, CarouselRepository $carouselRepository): Response
    {
        $content = $homeRepository->findOneBy(["isActive" => true]);
        $carousels = $carouselRepository->findBy(["tag"=>"home"]);
        return $this->render('front_home/index.html.twig', [
            'contenu' => $content,
            'carousels' => $carousels,
        ]);
    }
}
