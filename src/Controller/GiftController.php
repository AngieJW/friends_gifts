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
        $this->addFlash('info', 'Your gift list has been created');
      }

        return $this->render('gift/index.html.twig', [
            'controller_name' => 'GiftController',
        ]);
    }

    #[Route('/gift/add/{name}/{content}', name: 'app_gift.add')]
    public function addGift(Request $request, $name, $content): Response
    {
      $session = $request->getSession();
      if ( $session->has('gifts') ) {
        $gifts = $session->get('gifts');
        if (isset($gifts[$name])) {
          $this->addFlash('error', "Your gift $name already exists");
        } else {
          $gifts[$name] = $content;
          $session->set('gifts', $gifts);
          $this->addFlash('info', 'Your gift has been added');
        }
      } else {
        $this->addFlash('error', 'Your gift list does not exist');
      }

      return $this->redirectToRoute('app_gift');
    }
}
