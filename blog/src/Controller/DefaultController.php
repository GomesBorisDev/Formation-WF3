<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function homepage()
    {
        return $this->render('default/index.html.twig', [
            'mon_prenom' => $_GET['firstname'] ?? 'unknow',
        ]);
    }
}
