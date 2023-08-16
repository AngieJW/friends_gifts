<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class GiftController extends AbstractController
{
    #[Route('/gift', name: 'app_gift')]
    public function index(Request $request): Response
    {
      $session = $request->getSession();
      if (!$session->has('gifts')) {
        $gifts = [
          'clothes' => 'clothes',
          'shoes' => 'shoes',
          'toys' => 'toys',
          'books' => 'books',
        ];
        $session->set('gifts', $gifts);
      }

        return $this->render('gift/index.html.twig', [
            'controller_name' => 'GiftController',
        ]);
    }
}
