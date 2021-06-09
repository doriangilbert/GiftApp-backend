<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController {

    #[Route(path: '/api/login', name:'api_login')]
    public function login() {
        
        $user = $this->getUser();
        //dd($user);
        return $this->json([
            'username' => '$user->getUsername()',
            'roles'=> '$user->getRoles()'
        ]);
    }

}