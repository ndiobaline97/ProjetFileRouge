<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Depot;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    /**
     * @Route("/", name="depot")
     */
    public function index()
    {
        return $this->render('depot/index.html.twig', [
            'controller_name' => 'DepotController',
        ]);
    }
    
     /**
     * @Route("/depot", name="faire_depot" ,methods={"POST"})
     */
    public function depot(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if(isset($values->montant)){
            $deposer = new depot();
            $deposer->setMontant($values->montant);
            $deposer->setDateDepot(new \DateTime());
            $rec = $this->getDoctrine()->getRepository(Compte::class)->find($values->compte);
            $deposer->setCompte($rec);
            //incrémenter le solde du compte
            $rec->setSolde($rec->getSolde()+$values->montant);
            $errors = $validator->validate($deposer);
            if(count($errors)){
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'content-Type' => 'application/json'
                ]);
            }
       
            $entityManager->persist($deposer);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'massage' => 'l\'argent a été déposé sur le compte du partenaire'
            ];
            return new JsonResponse($data,201);
        }
            $data = [
                'status' => 500,
                'massage' => 'l\'argent a été déposé sur le compte du partenaire'
            ];
            return new JsonResponse($data,500);
        }
}
