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

    /**
     * @Route("/group_petition")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function group_petition(){
        return $this->render('petition/group_petition.html.twig',[

        ]);
    }

    /**
     * @Route("/voters")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function group_voters(){
        return $this->render('petition/voters.html.twig',[]);
    }

    /**
     * @Route("/voter")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function group_voter(){
        return $this->render('petition/voter.html.twig',[]);
    }

    /**
     * @Route("cur_petition")
     */
    public function cur_petition(){
        return $this->render('petition/cur_petition.html.twig',[]);
    }

}
