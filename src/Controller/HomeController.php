<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(LoggerInterface $logger)
    {
        $logger->error('FIRST PAGE', ['context' => 'tmp']);

        return $this->render('home/index.html.twig', [
            'title' => 'World!!!',
        ]);
    }
}
