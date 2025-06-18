<?php

namespace App\Controller;

use App\Entity\Planeta;
use App\Form\PlanetaForm;
use App\Repository\PlanetaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/planeta/local')]
final class PlanetaLocalController extends AbstractController
{
    #[Route(name: 'app_planeta_local_index', methods: ['GET'])]
    public function index(PlanetaRepository $planetaRepository): Response
    {
        return $this->render('planeta_local/index.html.twig', [
            'planetas' => $planetaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_planeta_local_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $planetum = new Planeta();
        $form = $this->createForm(PlanetaForm::class, $planetum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planetum);
            $entityManager->flush();

            return $this->redirectToRoute('app_planeta_local_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planeta_local/new.html.twig', [
            'planetum' => $planetum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planeta_local_show', methods: ['GET'])]
    public function show(Planeta $planetum): Response
    {
        return $this->render('planeta_local/show.html.twig', [
            'planetum' => $planetum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_planeta_local_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Planeta $planetum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlanetaForm::class, $planetum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_planeta_local_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planeta_local/edit.html.twig', [
            'planetum' => $planetum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planeta_local_delete', methods: ['POST'])]
    public function delete(Request $request, Planeta $planetum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planetum->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($planetum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_planeta_local_index', [], Response::HTTP_SEE_OTHER);
    }
}
