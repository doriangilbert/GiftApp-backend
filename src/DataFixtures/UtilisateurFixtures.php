<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Utilisateur;

/**
 * @var \Fixture 
 */
class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 10; $i++) { 
            $user = new Utilisateur();
            $user->setMail("$i@gmail.com")->setMdp(hash('sha256',"$i"))->setCreatedAt(new \DateTime());
            $manager->persist($user);
        }

        $manager->flush();
    }
}
