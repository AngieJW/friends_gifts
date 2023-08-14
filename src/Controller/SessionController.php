<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Request $request): Response
    {
        // session_start();
        $session = $request->getSession();

        // count the number of visits
        if ($session->has('nbVisits')) {
          $nbVisits = $session->get('nbVisits') + 1;
        } else {
            $nbVisits = 1;
        }
        $session->set('nbVisits', $nbVisits);

        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
