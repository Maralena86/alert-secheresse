<?php

namespace App\Controller;

use App\Entity\Usages;
use App\Form\UsagesType;
use App\Repository\UsagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/usages')]
class UsagesController extends AbstractController
{
    #[Route('/', name: 'app_usages_index', methods: ['GET'])]
    public function index(UsagesRepository $usagesRepository): Response
    {
        return $this->render('usages/index.html.twig', [
            'usages' => $usagesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_usages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UsagesRepository $usagesRepository): Response
    {
        $usage = new Usages();
        $form = $this->createForm(UsagesType::class, $usage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usagesRepository->save($usage, true);

            return $this->redirectToRoute('app_usages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usages/new.html.twig', [
            'usage' => $usage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_usages_show', methods: ['GET'])]
    public function show(Usages $usage): Response
    {
        return $this->render('usages/show.html.twig', [
            'usage' => $usage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_usages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Usages $usage, UsagesRepository $usagesRepository): Response
    {
        $form = $this->createForm(Usages1Type::class, $usage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usagesRepository->save($usage, true);

            return $this->redirectToRoute('app_usages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('usages/edit.html.twig', [
            'usage' => $usage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_usages_delete', methods: ['POST'])]
    public function delete(Request $request, Usages $usage, UsagesRepository $usagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usage->getId(), $request->request->get('_token'))) {
            $usagesRepository->remove($usage, true);
        }

        return $this->redirectToRoute('app_usages_index', [], Response::HTTP_SEE_OTHER);
    }
}
