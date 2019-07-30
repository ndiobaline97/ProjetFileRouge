<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Form\Partenaire1Type;
use App\Entity\Depot;
use App\Form\User;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


    /**
     * @Route("/api")
     */
class PartenaireController extends AbstractController
{
    
    /**
     * @Route("/partenaire", name="partenaire_new", methods={"POST"})
     */

    public function newPartenaire(Request $request, EntityManagerInterface $entityManager):Response
    {
        $partenaire=new Partenaire();
        $form= $this->createForm(Partenaire1Type::class,$partenaire);
        $data =json_decode($request->getContent(),true);
        $form->handleRequest($request);
        $form->submit($data);
        $entityManager= $this->getDoctrine()->getManager();
        $entityManager->persist($partenaire);
        $entityManager->flush();
     return new Response('partenaire ajouter ',Response::HTTP_CREATED);
    }

    /**
     * @Route("/liste", name="liste_partenaire", methods={"GET"})
     */
    public function show(PartenaireRepository $PartenaireRepository, SerializerInterface $serializer)
    {
        $partenaire = $PartenaireRepository->findAll();
        $liste = $serializer->serialize($partenaire, 'json');

        return new Response($liste, 200, [
            'Content-Type' => 'application/json'
        ]
        );  
        
        
    }
}
