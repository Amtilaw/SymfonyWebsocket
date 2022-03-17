<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LaunchController extends AbstractController
{
    /**
     * @Route("/launch", name="app_launch")
     */
    public function index(): Response
    {
        return $this->render('launch/index.html.twig', [
            'controller_name' => 'LaunchController',
        ]);
    }
}
