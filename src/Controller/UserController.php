<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UsagesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/users/particulier', 'app_display_particulier')]
    public function displayUserParticulier(UsagesRepository $usagesRepository): Response
    {
        return $this->render('user/particulier.html.twig', [
        'usages'=>$usagesRepository->findAll()]
    );
    }
    #[Route('/users/geste', 'app_display_geste')]
    public function displayUserGestes(UsagesRepository $usagesRepository): Response
    {
        return $this->render('user/gestes.html.twig', [
        'usages'=>$usagesRepository->findAll()]
    );
    }
    #[Route('/users/alert', 'app_display_alert')]
    public function displayUserAlert(UsagesRepository $usagesRepository): Response
    {
        return $this->render('user/alert.html.twig', [
        'usages'=>$usagesRepository->findAll()]
    );
    }
}
