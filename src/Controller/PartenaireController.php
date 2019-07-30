<?php

namespace App\Controller;

use App\Entity\Partenaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/api")
 */
class PartenaireController extends AbstractController
{
    /**
     * @Route("/partenaire", name="partenaire_new", methods={"POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $partenaire = $serializer->deserialize($request->getContent(), Partenaire::class, 'json');

        $entityManager->persist($partenaire);
        $entityManager->flush();
        $info = [
            'status' => 201,
            'message' => 'le partenaire a été ajouté'
        ];
        return new JsonResponse($info, 500);
    }


    public function ajout(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {

        $partenaire = $serializer->deserialize($request->getContent(), Partenaire::class, 'json');

        $entityManager->persist($partenaire);
        $entityManager->flush();
        $info = [
            'status' => 201,
            'message' => 'lutilisateur a déjà été ajouté avec succees'
        ];
        return new JsonResponse($info, 500);

        $ajoutuser = $this->getDoctrine()->getRepository(Partenaire::class)->find(id);
    }
}
