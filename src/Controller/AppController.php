<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/health", name="health check")
     */
    public function health(): Response
    {
        return new Response(
            json_encode(['status' => 'healthy']),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('app_login', ['error' => null], Response::HTTP_SEE_OTHER);
    }
}