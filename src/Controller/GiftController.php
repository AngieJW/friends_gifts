<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class GiftController extends AbstractController
{
    #[Route('/gift', name: 'app_gift')]
    public function index(): Response
    {
        return $this->render('gift/index.html.twig', [
            'controller_name' => 'GiftController',
        ]);
    }
}
