<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class InscriptionController extends AbstractController
{

    /**
     * add @ to work
     * Route("/api/inscription/", name="inscription", methods={"POST"})
     */
    public function inscription(UtilisateurRepository $ur, Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        try {
            $newUser = $serializer->deserialize($request->getContent(), Utilisateur::class, 'json');
            if ($ur->findOneByMail($newUser->getMail()) === null) {

                $newUser->setCreatedAt(new \DateTime());
                $em->persist($newUser);
                $em->flush();
                return $this->json(["id" => $newUser->getId()], 201);
            } else {
                return $this->json([
                    'status' => 400,
                    'message' => "Mail already taken"
                ], 400);
            }
        } catch (NotEncodableValueException $err) {
            return $this->json([
                'status' => 400,
                'message' => $err->getMessage()
            ], 400);
        }
    }
}
