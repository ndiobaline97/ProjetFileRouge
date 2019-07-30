<?php

namespace App\Controller;
use App\Entity\User;
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
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
 * @Route("/user", name="money_new", methods={"POST"})
 */
public function newUser(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
{
    $user = $serializer->deserialize($request->getContent(), User::class,'json');
    
    $entityManager->persist($user);
    $entityManager->flush();
    $info = [
                'statut' => 201,
                'messager'=> 'Utilisateur a été ajouté'
    ];
        return new JsonResponse($info, 500);
}
}
