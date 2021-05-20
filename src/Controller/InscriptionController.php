<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController {

    /**
     * @Route("/api/inscription/{a?inconnu}", name="inscription")
     */
    public function inscription($a, LoggerInterface $logger) {
        $logger->info("$a");
        return new Response("Hello $a");
    }

}
