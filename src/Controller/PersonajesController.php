<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;


final class PersonajesController extends AbstractController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/personajes', name: 'app_personajes')]
    public function obtenerPersonajes(): Response
      {
        $response = $this->httpClient->request('GET', 'https://dragonball-api.com/api/characters');
        $data = $response->toArray(); 
        return $this->render('personajes/personajes.html.twig', [
            'personajes' => $data['items'] ?? [],
        ]);
    }
}
