<?php

namespace App\Controller;

use App\Entity\CategorieUtilisateur;
use App\Form\CategorieUtilisateurType;
use App\Repository\CategorieUtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieUtilisateurController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie_utilisateur')]
    public function index(): Response
    {
        return $this->render('categorie_utilisateur/index.html.twig', [
            'controller_name' => 'CategorieUtilisateurController',
        ]);
    }
    #[Route('/categorie/create', name: 'app_categorie_create')]
    public function createCategory(Request $request, CategorieUtilisateurRepository $repository): Response
    {
        $form = $this->createForm(CategorieUtilisateurType::class);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $categorie = $form ->getData();
            
            $repository->save($categorie, true);
            return $this->redirectToRoute('app_categorie_list');
        }
        return $this->render('categorie_utilisateur/create-category.html.twig', [
            'form' =>$form->createView()
        ]);          
    }
    #[Route('/categorie/list', name: 'app_categorie_list')]
    public function listCategory(CategorieUtilisateurRepository $category): Response
    {
        return $this->render('categorie_utilisateur/list-category.html.twig', [
            'categories'=> $category->findAll(),
        ]);    
    }


}
