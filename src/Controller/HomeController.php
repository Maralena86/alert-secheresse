<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\CategorieUtilisateur;
use App\Repository\CategorieUtilisateurRepository;
use App\Services\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    
    #[Route('/','app_home')]
    public function displayHome(CategorieUtilisateurRepository $categories, CallApiService $api): Response
    {
        
        
        return $this->render('user/home.html.twig', [
            'categories' => $categories->findAll(),
            'villes' => $api->getFranceData()
        ]);
        
    }
}
