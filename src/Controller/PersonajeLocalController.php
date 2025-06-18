<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Form\PersonajeForm;
use App\Repository\PersonajeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/personaje/local')]
final class PersonajeLocalController extends AbstractController
{
    #[Route(name: 'app_personaje_local_index', methods: ['GET'])]
    public function index(PersonajeRepository $personajeRepository): Response
    {
        return $this->render('personaje_local/index.html.twig', [
            'personajes' => $personajeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_personaje_local_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $personaje = new Personaje();
        $form = $this->createForm(PersonajeForm::class, $personaje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($personaje);
            $entityManager->flush();

            return $this->redirectToRoute('app_personaje_local_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('personaje_local/new.html.twig', [
            'personaje' => $personaje,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personaje_local_show', methods: ['GET'])]
    public function show(Personaje $personaje): Response
    {
        return $this->render('personaje_local/show.html.twig', [
            'personaje' => $personaje,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_personaje_local_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Personaje $personaje, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PersonajeForm::class, $personaje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_personaje_local_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('personaje_local/edit.html.twig', [
            'personaje' => $personaje,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personaje_local_delete', methods: ['POST'])]
    public function delete(Request $request, Personaje $personaje, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personaje->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($personaje);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_personaje_local_index', [], Response::HTTP_SEE_OTHER);
    }
}
