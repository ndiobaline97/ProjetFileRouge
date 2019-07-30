<?php

namespace App\Controller;

use App\Entity\Depot;
use App\Entity\Compte;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */
class DepotController extends AbstractController
{
    
    public function index()
    {
        return $this->render('depot/index.html.twig', [
            'controller_name' => 'DepotController',
        ]);
    }

    /**
     * @Route("/depot", name="faire_depot" ,methods={"POST"})
     */


    public function depot(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if (isset($values->montant)) {
            $deposer = new Depot();
            $deposer->setMontant($values->montant);
            $deposer->setDateDepot(new \DateTime());
            $rec = $this->getDoctrine()->getRepository(Compte::class)->find($values->idcompte);
            $deposer->setIddepot($rec);
            $rec->setSolde($rec->getSolde()+$values->montant);
            $errors = $validator->validate($deposer);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($deposer);
            $entityManager->flush();

            $info = [
                'status' => 201,
                'message' => 'le depot a été effectué'
            ];
            return new JsonResponse($info, 500);
        }

        $info = [
            'status' => 500,
            'message' => 'le depot a été effectué'
        ];
        return new JsonResponse($info, 500);
    }
}
     

