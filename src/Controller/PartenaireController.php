<?php

namespace App\Controller;

use App\Entity\Partenaire;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api")
 */
class PartenaireController extends AbstractController
{
/**
 * @Route("/partenaire", name="partenaire_new", methods={"POST"})
 */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $partenaire = $serializer->deserialize($request->getContent(), Partenaire::class,'json');
        
        $entityManager->persist($partenaire);
        $entityManager->flush();
        $info = [
                    'status' => 201,
                    'message'=> 'le partenaire a déjà été ajouté'
        ];
            return new JsonResponse($info, 500);
    }
 
}


