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

    #[Route('/gift/update/{name}/{content}', name: 'app_gift.update')]
    public function updateGift(Request $request, $name, $content): Response
    {
      $session = $request->getSession();
      if ( $session->has('gifts') ) {
        $gifts = $session->get('gifts');
        if (isset($gifts[$name])) {
          $gifts[$name] = $content;
          $session->set('gifts', $gifts);
          $this->addFlash('info', "Your gift $name has been updated");
        } else {
          $this->addFlash('error', "Your gift $name does not exist");
        }
      } else {
        $this->addFlash('error', 'Your gift list does not exist');
      }

      return $this->redirectToRoute('app_gift');
    }

    #[Route('/gift/delete/{name}', name: 'app_gift.delete')]
    public function deleteGift(Request $request, $name): Response
    {
      $session = $request->getSession();
      if ( $session->has('gifts') ) {
        $gifts = $session->get('gifts');
        if (isset($gifts[$name])) {
          unset($gifts[$name]);
          $session->set('gifts', $gifts);
          $this->addFlash('info', "Your gift $name has been deleted");
        } else {
          $this->addFlash('error', "Your gift $name does not exist");
        }
      } else {
        $this->addFlash('error', 'Your gift list does not exist');
      }

      return $this->redirectToRoute('app_gift');
    }

    #[Route('/gift/reset', name: 'app_gift.reset')]
    public function resetGift(Request $request): Response
    {
      $session = $request->getSession();
      if ( $session->has('gifts') ) {
        $session->remove('gifts');
        $this->addFlash('info', 'Your gift list has been reset');
      } else {
        $this->addFlash('error', 'Your gift list does not exist');
      }

      return $this->redirectToRoute('app_gift');
    }

}
