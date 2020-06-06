<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PetitionController
 * @package App\Controller
 * @Route("/petition")
 */
class PetitionController extends AbstractController
{
    /**
     * @Route("/", name="petition")
     */
    public function index()
    {
        return $this->render('petition/index.html.twig', [
            'controller_name' => 'PetitionController',
        ]);
    }

    /**
     * @Route("/new")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(){
        return $this->render('petition/new.html.twig',[

        ]);
    }
}
