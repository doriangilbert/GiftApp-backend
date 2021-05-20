<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConnexionController extends AbstractController
{

    /**
     * @Route("/api/connexion/", name="connexion", methods={"GET"})
     */
    public function connexion(UtilisateurRepository $ur, Request $request)
    {
        $user = json_decode($request->getContent());

        $post = $ur->findOneBy(array("mail" => $user->mail, "mdp" => $user->mdp));
        if ($post !== null) {
            return $this->json($post, 200, [], ['groups' => 'read']);
        } else {
            return $this->json([
                'status' => 400,
                'message' => "User not found"
            ], 400);
        }
    }
}
