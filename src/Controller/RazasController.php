<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;


final class RazasController extends AbstractController
{
    private HttpClientInterface $httpClient;
    const RAZAS = ["Saiyan", "Namekian", "Human", "Frieza Race", "Android", "Majin", "God", "Unknown"];

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Razas disponbles para filtrar
     */
    #[Route('/razas', name: 'app_razas')]
    public function obtenerTodasLasRazas(): Response
    {
        return $this->render('razas/razas.html.twig', [
            'razas' => self::RAZAS,
        ]);
    }

    /**
     * Obtiene los personajes de la raza seleccionada
     * @param string raza correspondiente
     */
    #[Route('/personajesrazas/{raza}', name: 'app_personajes_razas')]
    public function obtenerPersonajesRaza(string $raza): Response
    {
        $response = $this->httpClient->request('GET', 'https://dragonball-api.com/api/characters?limit=58');
        $data = $response->toArray();

        $personajesFiltrados = [];

        foreach ($data['items'] as $personaje) {
            if ($personaje['race'] === $raza) {
                $personajesFiltrados[] = $personaje;
            }
        }

        return $this->render('razas/personajes_por_raza.html.twig', [
            'raza' => $raza,
            'personajes' => $personajesFiltrados,
        ]);
    }
}