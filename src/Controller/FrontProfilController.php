<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class FrontProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_front_profil')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {

        // On récupère l'utilisateur connecté
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        // On hydrate le formulaire avec les données de la requête
        $form->handleRequest($request);
        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()){
            // On traite le plainPassword si nécessaire
            if ($form->get('plainPassword')->getData()){

                $encodedPassword = $userPasswordHasherInterface->hashPassword($user, $form->get('plainPassword')->getData());
                $user->setPassword($encodedPassword);

            }
            // On persiste l'entité
            $em->persist($user);
            // On flush
            $em->flush();

            //Mise en place du flash message 
            $this->addFlash('success', 'Votre profil a boen été mis à jour');

            return $this->redirectToRoute('app_front_profil', [], Response::HTTP_SEE_OTHER);
        
        }

        return $this->render('front_profil/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
