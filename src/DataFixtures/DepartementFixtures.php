<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $departements = ['Direction', 'RH', 'Com', 'Dev']; // Ce sont les départements qui vont être ajoutés à la base de données grâce à la commande fixtures:load.

        foreach ($departements as $nom) {
            $departement = new Departement();
            $departement->setNom($nom);
            $manager->persist($departement);
        }

        $manager->flush();
    }
}
