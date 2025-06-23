<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Repository\PersonajeRepository;


final class HomeController extends AbstractController
{
    // private HttpClientInterface $httpClient;

    // public function __construct(HttpClientInterface $httpClient)
    // {
    //     $this->httpClient = $httpClient;
    // }

    /**
    * Obtención de todos los personajes de la API en caso contrario datos vacíos.
    */
    // #[Route('/home', name: 'app_home')]
    // public function obtenerPersonajes(): Response
    // {
    //     $response = $this->httpClient->request('GET', 'https://dragonball-api.com/api/characters?limit=12');
    //     $data = $response->toArray(); 
    //     return $this->render('home/home.html.twig', [
    //         'personajes' => $data['items'] ?? [],
    //     ]);
    // }

    /**
    * Obtención de todos los personajes de la BBDD local.
    */
    #[Route('/home', name: 'app_home', methods: ['GET'])]
    public function obtenerPersonajes(PersonajeRepository $personajeRepository): Response
    {
        return $this->render('home/home.html.twig', [
            'personajes' => $personajeRepository->findAll(),
        ]);
    }

}