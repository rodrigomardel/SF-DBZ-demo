<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class HomeController extends AbstractController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
    * Obtención de todos los personajes en caso contrario datos vacíos
    */
    #[Route('/home', name: 'app_home')]
    public function obtenerPersonajes(): Response
    {
        $response = $this->httpClient->request('GET', 'https://dragonball-api.com/api/characters');
        $data = $response->toArray(); 
        return $this->render('home/home.html.twig', [
            'personajes' => $data['items'] ?? [],
        ]);
    }
}