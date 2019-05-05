<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, LoggerInterface $logger, EntityManagerInterface $em, TagRepository $repo)
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($tag);
                $em->flush();

                $logger->notice('Success create tag', ['tag' => $tag]);

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('home/index.html.twig', [
            'title' => 'World!!!',
            'form' => $form->createView(),
            'list' => $repo->findAll(),
        ]);
    }
}
