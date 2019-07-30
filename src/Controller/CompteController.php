<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Depot;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/api")
 */
class CompteController extends AbstractController
{
    /**
     * @Route("/api", name="compte")
     */
    public function index()
    {
        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }
        
/**
 * @Route("/compte", name="money_new", methods={"POST"})
 */
public function alimenterCompte(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
{
    $money = $serializer->deserialize($request->getContent(), Compte::class,'json');
    
    $entityManager->persist($money);
    $entityManager->flush();
    $info = [
                'statut' => 201,
                'messager'=> 'le partenaire a déjà été ajouté'
    ];
        return new JsonResponse($info, 500);
}
}
