<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Club;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="club")
     */
    public function index()
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    /**
     * @Route("/clubs", name="clubs")
     */
    public function club()
    {
        $repository=$this->getDoctrine()->getRepository(club::class);
        $lesClubs=$repository->findAll();
        return $this->render('club/index.html.twig', [
            'clubs' => $lesClubs,
        ]);
    
    }
    /**
     * @Route("/clubs/modif/{id}", name="clubmodif")
     */
    public function clubmodif($id)
    {
        $repository=$this->getDoctrine()->getRepository(club::class);
        $lesClubs=$repository->find($id);
        $lesClubs->setNom("lille");


        $em=$this->getDoctrine()->getManager();
        $em->persist($lesClubs);
        $em->flush();

        return $this->redirectToRoute('clubs');
    
    }
    /**
     * @Route("/clubs/supp/{id}", name="clubsupp")
     */
    public function clubsup($id)
    {
        $repository=$this->getDoctrine()->getRepository(club::class);
        $lesClubs=$repository->find($id);
        $em=$this->getDoctrine()->getManager();

        $em->remove($lesClubs);
        $em->flush();
        
        return $this->redirectToRoute('clubs', [
            'clubs' => $lesClubs,
        ]);
    
    }
    










}
