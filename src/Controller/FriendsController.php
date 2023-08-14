<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FriendsController extends AbstractController
{
    #[Route('/friends', name: 'app_friends')]
    public function index(): Response
    {
        return $this->render('friends/index.html.twig', [
            'name' => 'Angie Duhard'
        ]);
    }

    #[Route('/friends/{id}', name: 'app_friends_show')]
    public function show($id): Response
    {
        return $this->render('friends/show.html.twig', [
            'id' => $id
        ]);
    }
}
